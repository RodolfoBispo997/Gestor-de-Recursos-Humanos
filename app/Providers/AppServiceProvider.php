<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //GATES
        Gate::define('admin', function(){
            //auth()->user() Faz parte da sessão do Usuário quando faz o Login
            return auth()->user()->role === 'admin';
        });

        Gate::define('rh', function(){
            //auth()->user() Faz parte da sessão do Usuário quando faz o Login
            return auth()->user()->role === 'rh';
        });

        Gate::define('colaborator', function(){
            //auth()->user() Faz parte da sessão do Usuário quando faz o Login
            return auth()->user()->role === 'colaborator';
        });
    }
}
