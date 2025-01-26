<?php

namespace App\Http\Controllers;

use App\Models\Barangkeluar;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the barang keluar.
     *
     * @return View
     */
    public function index()
    {
        $barangkeluar = BarangKeluar::paginate(10); // Paginate results with 10 items per page
        return view('barangkeluars.index', compact('barangkeluars'));
    }
    
    public function create(): View
    {
        return view('barangkeluars.create');
    }

    /**
     * Store a newly created barang keluar in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data
        $request->validate([
            'Nama_barang' => 'required|string|max:255',
            'Tanggal' => 'required|date',
        ]);

        // Simpan data barang keluar
        BarangKeluar::create([
            'Nama_barang' => $request->Nama_barang,
            'Tanggal' => $request->Tanggal,
        ]);

        return redirect()->route('barangkeluars.index')->with('success', 'Barang keluar berhasil disimpan!');
    }

    /**
     * Display the specified barang keluar.
     *
     * @param string $id
     * @return View
     */
    public function show(string $id): View
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        return view('barangkeluars.show', compact('barangKeluar'));
    }

    /**
     * Show the form for editing the specified barang keluar.
     *
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        return view('barangkeluars.edit', compact('barangKeluar'));
    }

    /**
     * Update the specified barang keluar in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Validasi data
        $request->validate([
            'Nama_barang' => 'required|string|max:255',
            'Tanggal' => 'required|date',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);

        // Perbarui data barang keluar
        $barangKeluar->update([
            'Nama_barang' => $request->Nama_barang,
            'Tanggal' => $request->Tanggal,
        ]);

        return redirect()->route('barangkeluars.index')->with('success', 'Barang keluar berhasil diperbarui!');
    }

    /**
     * Remove the specified barang keluar from the database.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->delete();

        return redirect()->route('barangkeluars.index')->with('success', 'Barang keluar berhasil dihapus!');
    }
    public function konfirmasi($id)
    {
        // Logika untuk mengkonfirmasi barang keluar dengan ID $id
        // Misalnya, update status barang menjadi "terkonfirmasi"
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->status = 'terkonfirmasi';
        $barangKeluar->save();

        return redirect()->back()->with('success', 'Barang keluar berhasil dikonfirmasi');
    }

    public function filter(Request $request)
    {
        // Logika untuk melakukan filter berdasarkan request
        $barangKeluar = BarangKeluar::where('nama_barang', 'like', '%' . $request->search . '%')->get();

        return view('barangkeluars.index', compact('barangKeluars'));
    }

}