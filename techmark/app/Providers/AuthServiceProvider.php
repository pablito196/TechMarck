<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

         $gate->define('allow-edit',function($user){
            return $user->allowEdit();
        });
        /*
         * policy revisa permiso borrado
         */
        $gate->define('allow-delete',function($user){
            return $user->allowDelete();
        });
        /*
         * policy revisa permiso insersion
         */
        $gate->define('allow-insert',function($user){
            return $user->allowInsert();
        });
        /*
         * policy revisa permiso lectura
         */
        $gate->define('allow-read',function($user){
            return $user->allowRead();
        });
    }
}
