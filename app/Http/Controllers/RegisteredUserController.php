<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Show the form for editing the user profile.
     */
    public function show($id)
    {
        $users = User::findOrFail($id);

        return view('users.profile', compact('users'));
    }

    /**
     * Update the user profile in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'max:255'],
            'signature_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('signature_path')) {
            if ($user->signature_path) {
                // Storage::disk('public')->delete($user->signature_path);
                Storage::delete($user->signature_path);
            }
            $user->signature_path = $request->file('signature_path')->store('images', 'public');
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && $user->avatar !== 'images/avatar.png') {
                Storage::delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('images', 'public');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->back();
    }
}
