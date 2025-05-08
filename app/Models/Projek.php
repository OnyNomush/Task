<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $guarded = [];

        public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

}
