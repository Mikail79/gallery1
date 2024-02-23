<?php

namespace App\Http\Controllers;

use App\Models\KomentarFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $fotoId)
    {
        $request->validate([
            'comment'=>'required'
        ]);

        KomentarFoto::create([
            'comment'=> $request->comment,
            'foto_id'=> $fotoId,
            'user_id'=> Auth::user()->id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(KomentarFoto $komentarFoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KomentarFoto $komentarFoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $komentar=KomentarFoto::find($id);
        $komentarRequest=$request->validate([
            'comment'=> 'required',
            
            
        ],[
            'comment.required'=> 'Komentar harus diisi',
            
            
        ]);
        $komentar->update($komentarRequest);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $komentarFoto = KomentarFoto::find($id);
        if (Auth::user()->role=='admin') {
            $komentarFoto->delete();     
        }
        elseif ($komentarFoto->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', 'Kamu tidak boleh menghapus komentar orang lain!');
        }
        
        $komentarFoto->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
    }
}
