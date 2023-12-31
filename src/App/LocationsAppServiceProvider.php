<?php
/**
 * Description of LocationsAppServiceProvicer.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk;

use Illuminate\Support\ServiceProvider;

class LocationsAppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/locations-api-sdk.php',
            'locations-server'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/locations-api-sdk.php' => config_path('locations-api-sdk.php'),
        ], 'config');
    }
}
