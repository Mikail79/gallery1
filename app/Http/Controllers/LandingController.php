<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $albums = Album::get();
        return view("Landing.index", compact('albums'));
    }

    public function albumIndex($id)
    {
        $album = Album::where('id', $id)->first();
        return view("Landing.album", compact('album'));
    }
}
