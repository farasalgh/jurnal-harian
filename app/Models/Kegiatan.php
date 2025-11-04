<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    //
    protected $fillable = ([
        'id_siswa',
        'tanggal',
        'mulai_kegiatan',
        'selesai_kegiatan',
        'dokumentasi',
        'catatan_pembimbing',
        'keterangan_kegiatan',
    ]);

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
