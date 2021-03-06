<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_pembeli extends Model
{
    //
    protected $fillable = [
        'nama_pembeli', 
        'alamat_pembeli', 
        'nomor_hp', 
        'id_user'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }

    public function riwayat_pembeli() {
        return $this->hasMany(riwayat_pembeli::class, 'id');
    }
}
