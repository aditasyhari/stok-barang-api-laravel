<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stok_barang extends Model
{
    //
    protected $fillable = [
        'nama_barang',
        'asal_barang',
        'jumlah_barang',
        'tanggal',
        'id_user'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }

    
}
