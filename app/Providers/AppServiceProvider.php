<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Reason\ReasonRepository;
use App\Repositories\Reason\ReasonRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ReasonRepositoryInterface::class, ReasonRepository::class);
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
