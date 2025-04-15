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
        ])->validate();

        return User::create([
            'firstname'     => $input['firstname'],
            'lastname'      => $input['lastname'],
            'email'         => $input['email'],
            'password'      => Hash::make($input['password']),
            'register_date' => now(),
            'user_type'     => 'user',      // Valeur par défaut
            'newsletter'    => false,       // Par défaut, non abonné
            'trials'        => 0,           // Par défaut à zéro
            'is_provider'   => false,
            'is_banned'     => false,
            'is_verified'   => false,
            'is_active'     => true,
        ]);
    }
}
