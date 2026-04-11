<?php

namespace App\Providers;

use App\Models\Alert;
use App\Observers\AlertObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
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
    public function boot(): void
    {
        if (session()->has('locale')) {
        App::setLocale(session('locale'));
        Paginator::useBootstrap();
        }
        Alert::observe(AlertObserver::class);
    }
}
