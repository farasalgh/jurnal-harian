<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $fillable = ([
        'id_users',
        'id_kelas',
        'id_jurusan',
        'nis',
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'gol_darah',
        'alamat',
        'nomor',
        'id_dudi',
        'id_pembimbing',
    ]);

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function dudi()
    {
        return $this->belongsTo(Dudi::class, 'id_dudi');
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'id_siswa');
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'id_pembimbing');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }


    public function absen()
    {
        return $this->hasMany(Absen::class, 'id_siswa');
    }
}
