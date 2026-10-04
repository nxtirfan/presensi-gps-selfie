<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'guru_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'no_hp',
        'email',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
