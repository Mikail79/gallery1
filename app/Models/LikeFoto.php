<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeFoto extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function foto()
    {
        return $this->belongsTo(Foto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
