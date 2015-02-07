<?php

namespace Authority\AuthorityL5;

use Authority\Authority;
use Illuminate\Support\ServiceProvider;

class AuthorityL5ServiceProvider extends ServiceProvider {
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app['authority'] = $this->app->share(function($app){
            $user = $app['auth']->user();
            
            $authority = new Authority($user);
            
            $fn = $app['config']->get('authority.initialize', null);

            if ($fn) {
                $fn($authority);
            }

            return $authority;
        });
        
        $this->app->alias('authority', 'Authority\Authority');
    }

}
