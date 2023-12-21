<?php
namespace mi\crud;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;


class CrudServiceProvider extends ServiceProvider{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'crud');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->publishes([
            __DIR__ . '/../public' => public_path(''),
        ], 'public');

        Paginator::useBootstrap();
        config([
            'auth.providers.users.model'=> \mi\crud\Models\User::class,
            'app.providers'=>\Maatwebsite\Excel\ExcelServiceProvider::class,
            'app.aliases.Excel'=>\Maatwebsite\Excel\ExcelServiceProvider::class,
            'excel.imports.ignore_empty'=> true,
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
