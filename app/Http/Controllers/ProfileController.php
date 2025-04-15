<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Localite;

class ProfileController extends Controller
{
    public function show()
    {
        $localites = Localite::all();
        return view('profile.edit', compact('localites'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'max:1024'], // 1Mo max, par exemple
            // Champs d'adresse :
            'street'         => 'nullable|string|max:255',
            'number'         => 'nullable|string|max:10',
            'localite_id'    => 'nullable|exists:localites,id',
        ]);

        if ($request->hasFile('profile_photo')) {
            // Traitement de l'upload de la photo de profil
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validatedData['profile_photo_path'] = $path;
        }

        $user->update($validatedData);

        // Mettre à jour ou créer l'adresse
        if ($request->filled('street') || $request->filled('number') || $request->filled('localite_id')) {
            // Si l'utilisateur a déjà une adresse, la mettre à jour, sinon la créer
            $user->address()->updateOrCreate(
                [], // conditions : ici on suppose qu'il n'y a qu'une seule adresse par utilisateur
                [
                    'street'      => $request->input('street'),
                    'number'      => $request->input('number'),
                    'localite_id' => $request->input('localite_id'),
                ]
            );
        }

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour!');
    }
}
