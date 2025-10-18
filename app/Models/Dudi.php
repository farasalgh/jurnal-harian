<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    //
    protected $fillable = ([
        'nama_dudi',
        'jenis_dudi',
        'alamat',
        'kontak',
        'pimpinan',
        'pembimbing', 
    ]);

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_users');
    }
}
