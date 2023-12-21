<?php
/**
 * Description of HereProvider.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Entities;

use Dots\Data\Entity;

class HereProvider extends Entity
{
    protected array $geoPositionApiKeys;

    protected array $routeApiKeys;

    protected array $autocompleteApiKeys;

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
}
