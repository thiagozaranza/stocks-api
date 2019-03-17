<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\{Setor, Segmento, Subsetor, Empresa, User, Indice, Ativo};
use App\Policies\{SetorPolicy, SegmentoPolicy, SubsetorPolicy, EmpresaPolicy, UserPolicy, IndicePolicy, AtivoPolicy};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Setor::class                => SetorPolicy::class,
        Segmento::class             => SegmentoPolicy::class,
        Subsetor::class             => SubsetorPolicy::class,
        Empresa::class              => EmpresaPolicy::class,
        User::class                 => UserPolicy::class,
        Indice::class               => IndicePolicy::class,
        Ativo::class                => AtivoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes(null, ['middleware' => [ \Barryvdh\Cors\HandleCors::class ]]);

        Passport::enableImplicitGrant();
    }
}
