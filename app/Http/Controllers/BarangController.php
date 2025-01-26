<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang dengan paginasi
     */
    public function index()
    {
        $barangs = Barang::paginate(10); // Mengambil data barang dengan paginasi
        return view('barangs.index', compact('barangs'));
    }

    // Method lainnya seperti `create`, `store`, `edit`, `update`, dan `destroy` tetap sama


    /**
     * Menampilkan form untuk menambah barang baru
     */
    public function create(): View
    {
        return view('barangs.create');
    }

    /**
     * Menyimpan data barang baru
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'received_date' => 'required|date',
        
        ]);

        // Simpan data barang baru
        Barang::create([
            'title' => $request->title,
            'received_date' => $request->received_date,
          
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit barang
     */
    public function edit($id): View
    {
        $barang = Barang::findOrFail($id);
        return view('barangs.edit', compact('barang'));
    }

    /**
     * Memperbarui data barang
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'received_date' => 'required|date',
            'stok' => 'nullable|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);

        // Update data barang
        $barang->update([
            'title' => $request->title,
            'received_date' => $request->received_date,
            'stok' => $request->stok ?? 0, // Jika stok kosong, set ke 0
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui!');
    }

    /**
     * Menghapus data barang
     */
    public function destroy($id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus!');
    }
}
