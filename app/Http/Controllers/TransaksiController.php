<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TransaksiController extends Controller
{
    public function index() : View
    {
        $transaksis = Transaksi::latest()->paginate(10);

        return view('transaksis.index', compact('transaksis'));
    }

    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = 'SB-Mid-server-lhp5feLFweQrDyQ0bLpzMjr4'; // Ganti dengan server key Anda
        Config::$isProduction = false; // Ubah ke true jika sudah production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function callback(Request $request)
    {
        $serverKey = Config::$serverKey;
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $transaction = Transaksi::where('order_id', $request->order_id)->first();

            if ($transaction) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $transaction->status = 'paid';
                } elseif ($request->transaction_status == 'pending') {
                    $transaction->status = 'pending';
                } elseif ($request->transaction_status == 'deny' || $request->transaction_status == 'expire') {
                    $transaction->status = 'failed';
                }
                $transaction->save();
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $products = Product::all(); // Ambil semua produk
        return view('transaksis.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'Tanggal_transaksi' => 'required|date',
            'Nama_pembeli' => 'required|string',
            'Jumlah_barang' => 'required|integer|min:1',
        ]);

        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($request->product_id);

        // Cek apakah stock cukup
        if ($product->stock < $request->Jumlah_barang) {
            return redirect()->back()->with('error', 'stock produk tidak mencukupi');
        }

        // Hitung total pembayaran
        $total_payment = $product->price * $request->Jumlah_barang;

        // Data untuk transaksi Midtrans
        $transactionDetails = [
            'order_id' => 'ORDER-' . uniqid(),
            'gross_amount' => $total_payment,
        ];

        $itemDetails = [
            [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => $request->Jumlah_barang,
                'name' => $product->title,
            ],
        ];

        $customerDetails = [
            'first_name' => $request->Nama_pembeli,
            'email' => $request->email, // Pastikan input email ada
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        // Buat Snap token
        $snapToken = Snap::getSnapToken($params);

        // Simpan transaksi ke database (opsional: buat status awal "pending")
        $transaksi = Transaksi::create([
            'product_id' => $request->product_id,
            'Tanggal_transaksi' => $request->Tanggal_transaksi,
            'Nama_pembeli' => $request->Nama_pembeli,
            'Jumlah_barang' => $request->Jumlah_barang,
            'Total_pembayaran' => $total_payment,
            'status' => 'pending', // Set status awal
            'snap_token' => $snapToken, // Simpan token Snap
        ]);
        // Kurangi stock produk
        $product->stock -= $request->Jumlah_barang;
        $product->save();

        // Redirect ke halaman pembayaran
        return view('transaksis.payment', compact('snapToken', 'transaksi'));
    }

    public function show(string $id): View
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksis.show', compact('transaksi'));
    }

    public function edit(string $id): View
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksis.edit', compact('transaksi'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'Tanggal_transaksi'  => 'required|date',
            'Nama_pembeli'       => 'required|min:1',
            'Jumlah_barang'      => 'required|numeric',
            'Total_pembayaran'   => 'required|numeric'
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'Tanggal_transaksi' => $request->Tanggal_transaksi,
            'Nama_pembeli' => $request->Nama_pembeli,
            'Jumlah_barang' => $request->Jumlah_barang,
            'Total_pembayaran' => $request->Total_pembayaran
        ]);

        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id): RedirectResponse
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function batal($id): RedirectResponse
    {
        $transaksi = Transaksi::findOrFail($id);
        $product = Product::findOrFail($transaksi->product_id);

        $product->stock += $transaksi->Jumlah_barang;
        $product->save();

        $transaksi->delete();

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dibatalkan dan stock produk telah diperbarui.');
    }

    public function ranking(): View
    {
        // Ambil data produk dan transaksi dengan penjualan terbanyak per tanggal
        $data = DB::table('transaksis')
            ->join('products', 'transaksis.product_id', '=', 'products.id')
            ->select(
                DB::raw('DATE(transaksis.Tanggal_transaksi) as Tanggal'),
                'products.title as Produk',
                DB::raw('SUM(transaksis.Jumlah_barang) as TotalPenjualan')
            )
            ->groupBy('Tanggal', 'products.id', 'products.title')
            ->orderBy('Tanggal', 'asc')
            ->get()
            ->groupBy('Tanggal')
            ->map(function ($groupedData) {
                return $groupedData->sortByDesc('TotalPenjualan')->first();
            });

        // Format data untuk ditampilkan di view
        $ranking = $data->map(function ($item) {
            return [
                'Tanggal' => $item->Tanggal,
                'Produk' => $item->Produk,
                'TotalPenjualan' => $item->TotalPenjualan,
            ];
        })->values();

        // Kirim hasil ranking ke view
        return view('transaksis.ranking', compact('ranking'));
    }
}
