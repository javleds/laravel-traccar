<?php

namespace Javleds\Traccar;

use Illuminate\Support\ServiceProvider;

class TraccarServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes(
            [
                getBaseDir('config/traccar.php') => config_path('traccar.php'),
            ],
            'traccar-config'
        );
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            getBaseDir('config/traccar.php'),
            'traccar'
        );

        $this->app->singleton('traccar-client', function() {
            return new Api\Client(config('traccar.base_url'));
        });
    }
}
