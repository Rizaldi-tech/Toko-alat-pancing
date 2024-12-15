<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'Tanggal',
        'Pendapatan',
        'Jumlah_barang'
    ];

    /**
     * Generate laporan berdasarkan transaksi.
     *
     * @param  int|null $month (bulan yang akan difilter, default null untuk semua data)
     * @return \Illuminate\Support\Collection
     */
    public static function generateReport($month = null, $perPage = 10)
    {
        $query = transaksi::query();
    
        if ($month) {
            $query->whereMonth('Tanggal_transaksi', $month)
                  ->whereYear('Tanggal_transaksi', now()->year);
        }
    
        return $query->selectRaw('DATE(Tanggal_transaksi) as Tanggal, 
                                  SUM(Total_pembayaran) as Pendapatan, 
                                  SUM(Jumlah_barang) as Jumlah_barang')
                     ->groupByRaw('DATE(Tanggal_transaksi)')
                     ->orderByRaw('DATE(Tanggal_transaksi)')
                     ->paginate($perPage);
    }
    }
