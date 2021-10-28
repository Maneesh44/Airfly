<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;


class BladeExtrasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('hasrole', function(array $roles){
            if(Auth::user()){
                if(Auth::user()->hasRoles($roles)){
                    return true;
                }

                return false;
            }
        });
    }
}
