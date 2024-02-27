<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePictureName = time() . '.' . $profilePicture->extension();
            $profilePicture->move(public_path('profile-pictures'), $profilePictureName);
            $user->profile_picture = $profilePictureName;
            

            return redirect()->back()->with('success', 'Profile picture updated successfully.');
        } else {
            return redirect()->back()->with('error', 'No profile picture uploaded.');
        }
    }
}
