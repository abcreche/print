<?php

namespace ABCreche\Printer;

use Illuminate\Support\ServiceProvider;

class PrintServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('printer', function () {
            return new Printer;
        });

        $this->app->alias('printer', Printer::class);
    }
}
