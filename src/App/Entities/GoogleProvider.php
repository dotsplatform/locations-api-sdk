<?php
/**
 * Description of GoogleProvider.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Entities;

use Dots\Data\Entity;

class GoogleProvider extends Entity
{
    protected array $geoPositionApiKeys = [];

    protected array $routeApiKeys = [];

    protected array $autocompleteApiKeys = [];

    protected array $mapsApiKeys = [];

    public static function fromProvider(Provider $provider): static
    {
        return static::fromArray($provider->getData());
    }

    public function getGeoPositionApiKeys(): array
    {
        return $this->geoPositionApiKeys;
    }

    public function getRouteApiKeys(): array
    {
        return $this->routeApiKeys;
    }

    public function getAutocompleteApiKeys(): array
    {
        return $this->autocompleteApiKeys;
    }

    public function getMapsApiKeys(): array
    {
        return $this->mapsApiKeys;
    }
}
