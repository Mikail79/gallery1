<?php

namespace App\Policies;

use App\Models\User;

class AlbumPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user)
{
    // Hanya admin yang bisa melihat data album
    return $user->role === 'admin';
}

public function create(User $user)
{
    // Admin dan user biasa bisa membuat data album
    return $user->role === 'admin' || $user->role === 'user';
}
}
