<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Crée un nouvel utilisateur après une inscription valide.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'firstname'     => ['required', 'string', 'max:255'],
            'lastname'      => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => $this->passwordRules(),
            'user_type'     => ['required', 'in:user,provider'],
            // Champs pour Provider (optionnels si user_type == 'user')
            'company_name'  => 'required_if:user_type,provider|string|max:255',
            'website'       => 'nullable|url',
            'vat_number'    => 'required_if:user_type,provider|string|max:50',
            'telephone'     => 'required_if:user_type,provider|string|max:15',
            'description'   => 'nullable|string',
        ])->validate();

        return DB::transaction(function () use ($input) {
            // Création de l'utilisateur
            $user = User::create([
                'firstname'     => $input['firstname'],
                'lastname'      => $input['lastname'],
                'email'         => $input['email'],
                'password'      => Hash::make($input['password']),
                'register_date' => now(),
                'user_type'     => $input['user_type'],
                'newsletter'    => false,
                'trials'        => 0,
                'is_provider'   => $input['user_type'] === 'provider',
                'is_banned'     => false,
                'is_verified'   => false,
                'is_active'     => true,
            ]);

            // Si l'utilisateur s'inscrit en tant que Prestataire,
            // on tente de créer le prestataire associé et de synchroniser les catégories.
            if ($input['user_type'] === 'provider') {
                // Créer l'enregistrement dans la table service_providers
                $provider = $user->serviceProvider()->create([
                    'company_name'  => $input['company_name'],
                    'website'       => $input['website'] ?? null,
                    'company_email' => $input['email'], // ou un champ distinct selon votre logique
                    'telephone'     => $input['telephone'],
                    'vat_number'    => $input['vat_number'],
                    // 'creation_date' => now(), // si vous avez une colonne dédiée ou sinon utilisez created_at
                    'description'   => $input['description'] ?? null,
                    'is_active'     => true,
                ]);

                // Synchroniser les catégories sélectionnées dans la table pivot service_provider_service
                if (!empty($input['service_ids'])) {
                    $provider->services()->sync($input['service_ids']);
                }

                // Si une nouvelle catégorie est proposée, créer une entrée dans categorie_proposals
                if (!empty($input['new_category'])) {
                    \App\Models\CategorieProposal::create([
                        'user_id'       => $user->id,
                        'proposed_name' => $input['new_category'],
                        'status'        => 'pending',
                    ]);
                }
            }

            return redirect()->intended(route('dashboard'));

            return $user;
        });
    }


}
