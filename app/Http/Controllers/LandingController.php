<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\User;
use App\Models\Foto;
use Illuminate\Http\Request;

class LandingController extends Controller
{

    public function albumIndex($id)
    {
        $album = Album::findOrFail($id);
        
        // Check if user is authenticated
        if (!auth()->check()) {
            // User is not logged in, redirect to login page
            return redirect()->route('loginIndex')->with('error', 'Please login to view this album.');
        }
        
        return view("Landing.album", compact('album'));
    }

    public function fotoIndex()
    {
        $fotos = Foto::all();
        
        // Check if user is authenticated
        if (!auth()->check()) {
            // User is not logged in, redirect to login page
            return redirect()->route('loginIndex')->with('error', 'Please login to view this foto.');
        }
        
        return view("Landing.foto", compact('fotos'));
    }



    public function index(Request $request)
{
    // Fetch all albums initially
    $albums = Album::with('user');

    // Check if a search query is provided for albums
    if ($request->has('query')) {
        $searchQuery = $request->input('query');

        // Search albums by name, description, or user's name
        $albums->where('album_name', 'like', '%' . $searchQuery . '%')
            ->orWhere('description', 'like', '%' . $searchQuery . '%')
            ->orWhereHas('user', function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%');
            });
    }

    // Fetch all fotos initially
    $fotos = Foto::query();

    // Check if a search query is provided for fotos
    if ($request->has('query')) {
        $searchQuery = $request->input('query');

        // Search fotos by title
        $fotos->where('title', 'like', '%' . $searchQuery . '%');
    }

    // Retrieve albums and fotos
    $albums = $albums->get();
    $fotos = $fotos->get();

    return view("Landing.index", compact('albums', 'fotos'));
}

    
    


}
