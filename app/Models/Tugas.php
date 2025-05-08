<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'tanggal_deadline',
        'projek_id',
    ];

    public function projek()
    {
        return $this->belongsTo(Projek::class);
    }

    public function pic()
    {
        return $this->belongsToMany(User::class, 'tugas_user');
    }


}
