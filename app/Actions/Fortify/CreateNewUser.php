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
     * Crée un nouvel utilisateur (et prestataire si besoin), puis renvoie l’User.
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'firstname'     => ['required','string','max:255'],
            'lastname'      => ['required','string','max:255'],
            'email'         => ['required','string','email','max:255','unique:users'],
            'password'      => $this->passwordRules(),
            'user_type'     => ['required','in:user,provider'],
            // validations “provider only”
            'company_name'  => 'required_if:user_type,provider|string|max:255',
            'website'       => 'nullable|url|max:150',
            'vat_number'    => 'required_if:user_type,provider|string|max:50',
            'telephone'     => 'required_if:user_type,provider|string|max:15',
            'description'   => 'nullable|string',
            'service_ids'   => 'array',
            'service_ids.*' => 'exists:services,id',
            'new_category'  => 'nullable|string|max:255',
        ])->validate();

        return DB::transaction(function () use ($input) {
            // 1) création du user
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

            // 2) si prestataire, on crée aussi le profil + pivot + proposition
            if ($input['user_type'] === 'provider') {
                $provider = $user->serviceProvider()->create([
                    'company_name'   => $input['company_name'],
                    'company_email'  => $input['email'],
                    'telephone'      => $input['telephone'],
                    'vat_number'     => $input['vat_number'],
                    'website'        => $input['website'] ?? null,
                    'description'    => $input['description'] ?? null,
                    'is_active'      => true,
                    // 'creation_date' => now() si besoin
                ]);

                if (! empty($input['service_ids'])) {
                    $provider->services()->sync($input['service_ids']);
                }

                if (! empty($input['new_category'])) {
                    \App\Models\CategorieProposal::create([
                        'user_id'       => $user->id,
                        'proposed_name' => $input['new_category'],
                        'status'        => 'pending',
                    ]);
                }
            }

            return $user;
        });
    }
}
