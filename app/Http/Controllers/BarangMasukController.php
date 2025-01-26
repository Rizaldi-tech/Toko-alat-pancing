<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the barang masuk.
     *
     * @return View
     */
    public function index(): View
    {
        $barangMasuks = BarangMasuk::paginate(10); // Menampilkan 10 barang masuk per halaman
        return view('barangmasuks.index', compact('barangMasuks'));
    }

    /**
     * Show the form for creating a new barang masuk.
     *
     * @return View
     */
    public function create(): View
    {
        return view('barangmasuks.create');
    }

    /**
     * Store a newly created barang masuk in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data
        $request->validate([
            'Nama_barang' => 'required|string|max:255',
            'Tanggal' => 'required|date',
        ]);

        // Simpan data barang masuk
        BarangMasuk::create([
            'Nama_barang' => $request->Nama_barang,
            'Tanggal' => $request->Tanggal,
        ]);

        return redirect()->route('barangmasuks.index')->with('success', 'Barang Masuk berhasil disimpan!');
    }

    /**
     * Display the specified barang masuk.
     *
     * @param  string  $id
     * @return View
     */
    public function show(string $id): View
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuks.show', compact('barangMasuk'));
    }

    /**
     * Show the form for editing the specified barang masuk.
     *
     * @param  string  $id
     * @return View
     */
    public function edit(string $id): View
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuks.edit', compact('barangMasuk'));
    }

    /**
     * Update the specified barang masuk in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Validasi data
        $request->validate([
            'Nama_barang' => 'required|string|max:255',
            'Tanggal' => 'required|date',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);

        // Perbarui data barang masuk
        $barangMasuk->update([
            'Nama_barang' => $request->Nama_barang,
            'Tanggal' => $request->Tanggal,
        ]);

        return redirect()->route('barangmasuks.index')->with('success', 'Barang Masuk berhasil diperbarui!');
    }

    /**
     * Remove the specified barang masuk from the database.
     *
     * @param  string  $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->delete();

        return redirect()->route('barangmasuks.index')->with('success', 'Barang Masuk berhasil dihapus!');
    }
}
