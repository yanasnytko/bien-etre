<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'max:1024'], // 1Mo max, par exemple
        ]);

        if ($request->hasFile('profile_photo')) {
            // Traitement de l'upload de la photo de profil
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validatedData['profile_photo_path'] = $path;
        }

        $user->update($validatedData);

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour!');
    }
}
