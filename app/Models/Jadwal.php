<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'jadwal_id';
    public $timestamps = false;

    protected $fillable = [
        'tgl_jadwal',
        'waktu_mulai',
        'waktu_selesai',
        'keterangan',
    ];

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'jadwal_id', 'jadwal_id');
    }
}
