<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Organizer;
use App\Models\Event;
use App\Observers\OrganizerObserver;
use App\Observers\EventObserver;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $this->app->bind(
            \App\Repositories\EventRepositoryInterface::class,
            \App\Repositories\Eloquent\EventRepository::class
        );

        $this->app->bind(
            \App\Repositories\OrganizerRepositoryInterface::class,
            \App\Repositories\Eloquent\OrganizerRepository::class
        );
    }

}
