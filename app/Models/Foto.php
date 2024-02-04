<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function likeFoto()
    {
        return $this->hasMany(LikeFoto::class);
    }

    public function komentarFoto()
    {
        return $this->hasMany(KomentarFoto::class);
    }
}
