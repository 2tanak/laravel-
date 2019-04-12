<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Zadanie;
use App\Policies\ArticlePolicy;
use App\User;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
 
    protected $policies = [
        Zadanie::class => ArticlePolicy::class
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
        
      
        $gate->define('MANAGER', function ($user) {
			
			return $user->canDo2('MANAGER', FALSE);
        });
		

        
    }
}
