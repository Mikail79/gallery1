<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KomentarFotoController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LikeFotoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/album-landing/{id}', [LandingController::class, 'albumIndex'])->name('landing.album');

Route::middleware(['auth'])->group(function () {
    Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
    Route::get('/album/image/{albumId}', [FotoController::class, 'index'])->name('foto.index');
    Route::get('/album/image/{albumId}/create', [FotoController::class, 'create'])->name('foto.create');
    Route::post('/album/image/{albumId}/store', [FotoController::class, 'store'])->name('foto.store');
    Route::post('/album/image/{fotoId}/like', [LikeFotoController::class, 'store'])->name('like.add');
    Route::delete('/album/image/{id}/remove', [LikeFotoController::class, 'destroy'])->name('like.remove');
    Route::post('/album/image/{fotoId}/komentar', [KomentarFotoController::class, 'store'])->name('comment.add');
    Route::get('/album/create', [AlbumController::class, 'create'])->name('album.create');
    Route::put('/album/{id}/update', [AlbumController::class, 'update'])->name('album.update');
    Route::put('/foto/{id}/update', [FotoController::class, 'update'])->name('foto.update');
    Route::put('/comment/{id}/update', [KomentarFotoController::class, 'update'])->name('comment.update');
    Route::post('/album/store', [AlbumController::class, 'store'])->name('album.store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('/album/image/comment/{id}/remove', [KomentarFotoController::class, 'destroy'])->name('comment.remove');
    Route::delete('/album/{id}/remove', [AlbumController::class, 'destroy'])->name('album.remove');
    Route::delete('/foto/{id}/remove', [FotoController::class, 'destroy'])->name('foto.remove');
});

Route::get('/login', [AuthController::class, 'loginIndex'])->name('loginIndex');
Route::get('/register', [AuthController::class, 'registerIndex'])->name('registerIndex');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');




