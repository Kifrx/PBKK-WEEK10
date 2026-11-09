<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'kelompok',
        'deskripsi',
        'nilai',
        'catatan_review',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
