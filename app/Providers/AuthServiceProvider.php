<?php

namespace App\Providers;

use App\Models\ServiceProviderModel;
use App\Models\CommentModel;
use App\Models\CategorieProposalModel;
use App\Policies\ServiceProviderPolicy;
use App\Policies\CommentPolicy;
use App\Policies\CategorieProposalPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Les mappings des policies pour votre application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ServiceProviderModel::class => ServiceProviderPolicy::class,
        CommentModel::class         => CommentPolicy::class,
        CategorieProposalModel::class => CategorieProposalPolicy::class,
    ];

    /**
     * Enregistre les policies pour l'application.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-admin-dashboard', function ($user) {
            return $user->user_type === 'admin';
        });
    }
}
