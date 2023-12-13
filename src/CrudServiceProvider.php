<?php
namespace mi\crud;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;


class CrudServiceProvider extends ServiceProvider{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'crud');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->publishes([
            __DIR__.'/public'=> public_path(''),
            __DIR__.'/config/auth.php'=>config_path('mi_auth.php'),
        ], 'public');

        Paginator::useBootstrap();
        config([
            'auth.providers.users.model'=> \mi\crud\Models\User::class
        ]);

    }

    public function register()
    {
        $this->app->bind(
            'mi\crud\Contracts\Repositories\UserRepositoryInterface',
            'mi\crud\Repositories\UserRepository',
        );
    }
}
