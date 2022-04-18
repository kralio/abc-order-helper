<?php

namespace App\Providers;

use App\Services\OrderOrganizer;
use App\Contracts\Services\OrderOrganizer as OrderOrganizerContract;

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
        $this->app->bind(OrderOrganizerContract::class, OrderOrganizer::class);
    }
}
