<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $month = $request->input('month', now()->month);
        $laporans = Laporan::generateReport($month);

        return view('laporans.index', compact('laporans', 'month'));
    }

    public function create(): View
    {
        return view('laporans.create');
    }

    public function show(string $id): View
    {
        $laporan = Laporan::findOrFail($id);

        return view('laporans.show', compact('laporan'));
    }

    public function eksporPdf()
    {
        // Ambil data laporan dari database
        $laporans = DB::table('transaksis') // pastikan menggunakan nama tabel yang benar
            ->select('Tanggal_transaksi', 'Jumlah_barang', 'Total_pembayaran') // pastikan nama kolom sesuai
            ->get();

        // Cek apakah data kosong
        if ($laporans->isEmpty()) {
            return redirect()->route('laporans.index')->with('error', 'Tidak ada data untuk diekspor!');
        }

        // Generate PDF menggunakan Barryvdh\DomPDF
        $pdf = Pdf::loadView('laporans.pdf', compact('laporans'));

        // Unduh file PDF
        return $pdf->download('laporan.pdf');
    }

    public function edit(string $id): View
    {
        $laporan = Laporan::findOrFail($id);

        return view('laporans.edit', compact('laporan'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'Tanggal' => 'required|date',
            'Pendapatan' => 'required|numeric',
            'Jumlah_barang' => 'required|numeric'
        ]);

        $laporan = Laporan::findOrFail($id);

        $laporan->update([
            'Tanggal' => $request->Tanggal,
            'Pendapatan' => $request->Pendapatan,
            'Jumlah_barang' => $request->Jumlah_barang
        ]);

        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id): RedirectResponse
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
