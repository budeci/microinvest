<?php

namespace App\Providers;

use App\Http\ViewComposers\LanguageComposer;
use App\Http\ViewComposers\AuthSoapComposer;
use App\Http\ViewComposers\AplicationComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', AuthSoapComposer::class);
        view()->composer('*', AplicationComposer::class);
        view()->composer('*', LanguageComposer::class);
        view()->composer('*', function($view){
            return $view->with('meta', (new \App\Meta));
        });
        view()->composer('*', function($view){
            return $view->with('meta', (new \App\Translate));
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}