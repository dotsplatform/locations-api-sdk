<?php
/**
 * Description of Account.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Entities;

use Dots\Data\Entity;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;

class Account extends Entity
{
    protected string $id;

    protected string $name;

    protected string $region;

    protected ProviderType $geoPositionProviderType;

    protected ?ProviderType $autocompleteProviderType;

    protected ProviderType $routeDistancesProviderType;

    public static function fromArray(array $data): static
    {
        $data['geoPositionProviderType'] = ProviderType::from($data['geoPositionProviderType']);
        $data['routeDistancesProviderType'] = ProviderType::from($data['routeDistancesProviderType']);
        if (! empty($data['autocompleteProviderType'])) {
            $data['autocompleteProviderType'] = ProviderType::from($data['autocompleteProviderType']);
        }

        return parent::fromArray($data);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['geoPositionProviderType'] = $this->getGeoPositionProviderType()->value;
        $data['autocompleteProviderType'] = $this->getAutocompleteProviderType()?->value;
        $data['routeDistancesProviderType'] = $this->getRouteDistancesProviderType()->value;

        return $data;
    }

    public function getGeoPositionProviderType(): ProviderType
    {
        return $this->geoPositionProviderType;
    }

    public function getAutocompleteProviderType(): ?ProviderType
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
