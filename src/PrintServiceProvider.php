<?php

namespace ABCreche\Printer;

use ABCreche\Printer\ConverterManager;
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
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerViews();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/printer.php',
            'printer'
        );

        $this->app->bind('printer', function ($app) {
            $manager = new ConverterManager($app);

            return new Printer($manager->driver());
        });

        $this->app->alias('printer', Printer::class);

        $this->commands([
            PrintTemplateMakeCommand::class,
        ]);
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/printer.php' => config_path('printer.php'),
        ], 'printer-config');
    }

    /**
     * Register the package views.
     *
     * @return void
     */
    public function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'print');
    }
}
