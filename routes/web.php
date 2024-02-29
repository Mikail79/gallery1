<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KomentarFotoController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LikeFotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/album-landing/{id}', [LandingController::class, 'albumIndex'])->name('landing.album');
Route::get('/foto-landing', [LandingController::class, 'fotoIndex'])->name('landing.foto');

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
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/picture', [ProfileController::class, 'updatePicture'])->name('profile.picture');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/album', [AlbumController::class, 'index'])->name('admin.album.index');
    Route::get('/admin/album/image/{albumId}', [FotoController::class, 'index'])->name('admin.foto.index');
    Route::get('/admin/album/image/{albumId}/create', [FotoController::class, 'create'])->name('admin.foto.create');
    Route::post('/admin/album/image/{albumId}/store', [FotoController::class, 'store'])->name('admin.foto.store');
    Route::post('/admin/album/image/{fotoId}/like', [LikeFotoController::class, 'store'])->name('admin.like.add');
    Route::delete('/admin/album/image/{id}/remove', [LikeFotoController::class, 'destroy'])->name('admin.like.remove');
    Route::post('/admin/album/image/{fotoId}/komentar', [KomentarFotoController::class, 'store'])->name('admin.comment.add');
    Route::get('/admin/album/create', [AlbumController::class, 'create'])->name('admin.album.create');
    Route::put('/admin/album/{id}/update', [AlbumController::class, 'update'])->name('admin.album.update');
    Route::put('/admin/foto/{id}/update', [FotoController::class, 'update'])->name('admin.foto.update');
    Route::put('/admin/comment/{id}/update', [KomentarFotoController::class, 'update'])->name('admin.comment.update');
    Route::post('/admin/album/store', [AlbumController::class, 'store'])->name('admin.album.store');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::delete('/admin/album/image/comment/{id}/remove', [KomentarFotoController::class, 'destroy'])->name('admin.comment.remove');
    Route::delete('/admin/album/{id}/remove', [AlbumController::class, 'destroy'])->name('admin.album.remove');
    Route::delete('/admin/foto/{id}/remove', [FotoController::class, 'destroy'])->name('admin.foto.remove');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/ban-user/{userId}', [AdminController::class, 'banUser'])->name('admin.banUser');
});

Route::get('/login', [AuthController::class, 'loginIndex'])->name('loginIndex');
Route::get('/register', [AuthController::class, 'registerIndex'])->name('registerIndex');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
