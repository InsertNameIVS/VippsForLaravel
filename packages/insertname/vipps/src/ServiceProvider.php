<?php

namespace Insertname\Vipps;

use Insertname\Vipps\Console\CreateWebhook;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->publishesMigrations([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateWebhook::class,
            ]);
        }
    }

    public function register()
    {
        $this->app->bind('vipps', function() {
            return new Vipps();
        });
    }
}