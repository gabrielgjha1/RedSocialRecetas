<?php

namespace App\Providers;

use App\CategoriaRecetas;
use View;
use Illuminate\Support\ServiceProvider;

class CategoriasProviders extends ServiceProvider
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
        View::composer('*',function($view){
            $categorias = CategoriaRecetas::all();
            $view->with('categorias',$categorias);
        });
    }
}
