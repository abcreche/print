<?php

namespace ABCreche\Printer;

use Illuminate\Support\ServiceProvider;
use ABCreche\Printer\Console\PrintTemplateMakeCommand;

class PrintServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'print');
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

        $this->commands([
            PrintTemplateMakeCommand::class,
        ]);
    }
}
