<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) { 
            $action = app('request')->route()->getAction();
            $currentAction = \Route::currentRouteAction();
            if($currentAction != null){
                list($controller, $method) = explode('@', $currentAction);
                $controller = preg_replace('/.*\\\/', '', $controller);
            }else{
                $controller = '';
                $method = '';
            }

            $view->with(array('controller'=>$controller, 'action'=>$method));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
