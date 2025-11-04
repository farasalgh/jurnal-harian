<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    //
    protected $fillable = ([
        'id_siswa',
        'tanggal_absensi',
        'jam_masuk',
        'jam_pulang',
        'status',
        'keterangan',
    ]);

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
