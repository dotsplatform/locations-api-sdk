<?php

/**
 * Description of StoreLocationDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params\Locations;

use Dots\Data\DTO;
use Dots\Distance\Position;
use Dotsplatform\LocationsApiSdk\DTO\LocationSource;

class StoreLocationDTO extends DTO
{
    protected string $geoCityId;

    protected string $address;

    protected string $city;

    protected ?string $street;

    protected ?string $number;

    protected ?string $zip;

    protected LocationSource $source;

    protected Position $location;

    public static function fromArray(array $data): static
    {
        if (isset($data['location'])) {
            $data['location'] = Position::fromArray($data['location']);
        }

        return parent::fromArray($data);
    }

    public function getGeoCityId(): string
    {
        return $this->geoCityId;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function getSource(): LocationSource
    {
        return $this->source;
    }

    public function getLocation(): Position
    {
        return $this->location;
    }
}
