<?php

namespace dmcdenissen\urlalias;

use Illuminate\Support\ServiceProvider;

class UrlaliasServiceProvider extends ServiceProvider
{

    protected $defer = false;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '\\database\\migrations\\' => database_path('migrations'),
        ], 'migrations');

      
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->booted(function () {
            
            $this->loadRoutesFrom(__DIR__.'/routes/web.php');
       // dd($this->app['router']);
        // include __DIR__.'/routes/web.php';
       //  $this->app->make('dmcdenissen\urlalias\UrlaliasController');      
        });
    }

}
