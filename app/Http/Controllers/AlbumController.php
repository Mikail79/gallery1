<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::where('user_id', Auth::user()->id)->get();
        return view('album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Album.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'album_name'=>'required',
            'description'=>'required'
        ],[
            'album_name.required'=>'Nama Album harus diisi!',
            'description.required'=> 'Deskripsi harus diisi'
        ]);

        $userId = Auth::user()->id;

        Album::create([
            'album_name'=> $request->album_name,
            'description'=> $request->description,
            'user_id'=> $userId
        ]);

        return redirect()->route('album.index')->with('success','Album berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return view('album.show', compact($album));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $album = Album::find($id);
        return view('album.edit', compact($album));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $album = Album::find($id);
        $albumRequest = $request->validate([
                'album_name'=> 'required',
                'description'=> 'required'
            ],[
                'album_name.required'=> 'Album harus diisi',
                'description.required'=> 'Deskripsi harus diisi'
            ]);

        $album->update($albumRequest);
        return redirect()->route('album.index')->with('success','Album berhasil dimodifikasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        if (!$album) {
            return redirect()->route('album.index')->with('error', 'Album tidak ditemukan');
        }

        foreach ($album->foto as $photo) {
            $photo->delete();
        }

        $album->delete();
        return redirect()->route('album.index')->with('success','Album berhasil dihapus');
    }
}