<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => $this->passwordRules(),
            'user_type' => ['required', 'in:user,provider'], // Validation pour user_type
        ])->validate();

        return User::create([
            'firstname'     => $input['firstname'],
            'lastname'      => $input['lastname'],
            'email'         => $input['email'],
            'password'      => Hash::make($input['password']),
            'register_date' => now(),
            'user_type'     => $input['user_type'],   // Insérer le type choisi
            'newsletter'    => false,                  // Valeur par défaut
            'trials'        => 0,                      // Valeur par défaut
            'is_provider'   => $input['user_type'] === 'provider', // On peut le déterminer ici
            'is_banned'     => false,
            'is_verified'   => false,
            'is_active'     => true,
            // Champs d'adresse :
            'street'        => $input['street'] ?? null,
            'number'        => $input['number'] ?? null,
            'city'          => $input['city'] ?? null,
            'postal_code'   => $input['postal_code'] ?? null,
        ]);
    }
}
