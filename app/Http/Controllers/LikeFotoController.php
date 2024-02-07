<?php

namespace App\Http\Controllers;

use App\Models\LikeFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeFotoController extends Controller
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
    public function store($fotoId)
    {
        LikeFoto::create([
            'foto_id'=> $fotoId,
            'user_id'=> Auth::user()->id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(LikeFoto $likeFoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeFoto $likeFoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LikeFoto $likeFoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $likeFoto = LikeFoto::find($id);
        $likeFoto->delete($id);
        return redirect()->back();
    }
}
