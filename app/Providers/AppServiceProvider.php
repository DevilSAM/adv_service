<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Contracts\AdvertRepository;
use App\Repositories\Contracts\TaskRepository;
use App\Repositories\Contracts\WorkingProcessRepository;
use App\Repositories\EloquentAdvertRepository;
use App\Repositories\EloquentTaskRepository;
use App\Repositories\EloquentWorkingProcessRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdvertRepository::class, EloquentAdvertRepository::class);
        $this->app->bind(TaskRepository::class, EloquentTaskRepository::class);
        $this->app->bind(WorkingProcessRepository::class, EloquentWorkingProcessRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
