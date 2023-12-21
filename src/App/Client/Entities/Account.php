<?php
/**
 * Description of Account.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\App\Client\Entities;

use Dots\Data\Entity;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\ProviderType;

class Account extends Entity
{
    protected string $id;

    protected string $name;

    protected string $region;

    protected ProviderType $geoPositionProviderType;

    protected ProviderType $autocompleteProviderType;

    protected ProviderType $routeDistancesProviderType;

    public function getGeoPositionProviderType(): ProviderType
    {
        return $this->geoPositionProviderType;
    }

    public function getAutocompleteProviderType(): ProviderType
    {
        return $this->autocompleteProviderType;
    }

    public function getRouteDistancesProviderType(): ProviderType
    {
        return $this->routeDistancesProviderType;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRegion(): string
    {
        return $this->region;
    }
}