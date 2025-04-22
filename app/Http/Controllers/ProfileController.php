<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Localite;
use App\Models\Service;

class ProfileController extends Controller
{
    public function show()
    {
        $localites = Localite::all();
        $services  = Service::all();
        return view('profile.edit', compact('localites','services'));
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

            // Prestataire
            'company_name'    => 'required_if:user_type,provider|string|max:255',
            'website'         => 'nullable|url',
            'vat_number'      => 'required_if:user_type,provider|string|max:50',
            'telephone'       => 'required_if:user_type,provider|string|max:15',
            'description'     => 'nullable|string',
            'service_ids'     => 'nullable|array',
            'service_ids.*'   => 'exists:services,id',
            'new_category'    => 'nullable|string|max:255',
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

        // 5) Si c'est un prestataire, on met à jour son serviceProvider
        if ($user->is_provider) {
            // Récupère (ou crée) l'enregistrement service_providers
            $provider = $user->serviceProvider()->updateOrCreate(
                [],  // where user_id = $user->id
                [
                    'company_name'  => $validatedData['company_name'],
                    'website'       => $validatedData['website']        ?? null,
                    'vat_number'    => $validatedData['vat_number'],
                    'telephone'     => $validatedData['telephone'],
                    'description'   => $validatedData['description']    ?? null,
                    'company_email' => $user->email,
                    'is_active'     => true,
                ]
            );
    
            // 5.a) Synchroniser les catégories pivots
            if (isset($validatedData['service_ids'])) {
                $provider->services()->sync($validatedData['service_ids']);
            }
    
            // 5.b) Créer une proposition de catégorie si besoin
            if (!empty($validatedData['new_category'])) {
                \App\Models\CategorieProposal::create([
                    'user_id'       => $user->id,
                    'proposed_name' => $validatedData['new_category'],
                    'status'        => 'pending',
                ]);
            }
        }

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour!');
    }

    public function editPassword()
    {
        return view('profile.edit-password'); // Créez cette vue
    }

    /**
     * Met à jour le mot de passe de l'utilisateur authentifié.
     */
    public function updatePassword(Request $request)
    {
        // Valider le formulaire de changement de mot de passe
        $request->validate([
            'current_password'      => ['required'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'], // ajoutez vos règles personnalisées
        ]);

        $user = $request->user();

        // Vérifier que le mot de passe actuel correspond
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Le mot de passe actuel est incorrect.',
            ]);
        }

        // Mettre à jour le mot de passe de l'utilisateur
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard')->with('success', 'Mot de passe mis à jour avec succès!');
    }

    public function dashboard()
    {
        $user = auth()->user();

        $favorites = $user
            ->favorites()
            ->with('favoriteable') 
            ->get();

        // Si l'utilisateur est prestataire et possède un enregistrement dans service_providers
        if ($user->is_provider && $user->serviceProvider) {
            $stages = $user->serviceProvider->stages;
            $promotions = $user->serviceProvider->promotions;
        } else {
            $stages = collect();
            $promotions = collect();
        }

        return view('dashboard', compact('favorites', 'stages', 'promotions'));
    }
}
