<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($albumId)
    {
        $fotos = Foto::where('album_id',$albumId)->get();
        return view("Album.Image.index", compact("fotos", 'albumId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($albumId)
    {
        return view('Album.Image.create', compact('albumId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $albumId)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required:jpeg,png,jpg,gif,svg'
        ],[
            'title.required'=>'Judul harus diisi',
            'description.required'=>'Deskripsi harus diisi',
            'image.required'=>'Foto harus diisi'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $filePath = 'images/' . $imageName;

        $request->image->move(public_path('images'), $imageName);

        $foto = Foto::create([
            'user_id' => Auth::user()->id,
            'album_id' => $albumId,
            'title' => $request->title,
            'description' => $request->description,
            'file_location' => $filePath,
        ]);

        if (!$foto) {
            return redirect()->back()->with('error','Gagal membuat foto');
        }

        return redirect()->route('foto.index', $albumId)->with('success','Berhasil mengupload foto');
    }

    /**
     * Display the specified resource.
     */
    public function show(Foto $foto)
    {
        return view('album.show', compact('foto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto)
    {
        return view('album.edit', compact('foto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $foto=Foto::find($id);
        $fotoRequest=$request->validate([
            'title'=> 'required',
            'description'=> 'required',
            
        ],[
            'title.required'=> 'Judul harus diisi',
            'description.required'=>'Deskripsi harus diisi',
            
        ]);
        $foto->update($fotoRequest);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);
    
        // Delete the photo file
        Storage::delete($foto->file_location);
    
        // Delete the photo record
        $foto->delete();
    
        // Redirect back to the album page with a success message
        return redirect()->route('foto.index', $foto->album_id)->with('success', 'Foto berhasil dihapus.');
    }
}
