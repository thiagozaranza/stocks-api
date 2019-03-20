<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\{
    User,
    Setor,
    Segmento,
    Subsetor,
    Empresa,
    Indice,
    Ativo,
    TesouroCategoria,
    TesouroTipo,
    TesouroTitulo,
    TesouroCotacao
};
use App\Policies\{
    UserPolicy,
    SetorPolicy,
    SegmentoPolicy,
    SubsetorPolicy,
    EmpresaPolicy,
    IndicePolicy,
    AtivoPolicy,
    TesouroCategoriaPolicy,
    TesouroTipoPolicy,
    TesouroTituloPolicy,
    TesouroCotacaoPolicy
};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class                 => UserPolicy::class,

        Setor::class                => SetorPolicy::class,
        Segmento::class             => SegmentoPolicy::class,
        Subsetor::class             => SubsetorPolicy::class,
        Empresa::class              => EmpresaPolicy::class,
        
        Indice::class               => IndicePolicy::class,
        Ativo::class                => AtivoPolicy::class,

        TesouroCategoria::class     => TesouroCategoriaPolicy::class,
        TesouroTipo::class          => TesouroTipoPolicy::class,
        TesouroTitulo::class        => TesouroTituloPolicy::class,
        TesouroCotacao::class       => TesouroCotacaoPolicy::class,
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
