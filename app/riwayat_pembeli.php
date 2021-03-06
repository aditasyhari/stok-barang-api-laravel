<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class riwayat_pembeli extends Model
{
    //
    protected $fillable = [
        'tanggal_pembelian', 
        'nama_pembelian',
        'jumlah_pembelian',
        'harga_pembelian',
        'total_pembelian',
        'dibayar',
        'sisa',
        'id_pembeli'
    ];

    public function data_pembeli() {
        return $this->belongsTo(data_pembeli::class, 'id');
    }
}
