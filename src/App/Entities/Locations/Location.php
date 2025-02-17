<?php

/**
 * Description of Location.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Entities\Locations;

use Dots\Data\Entity;
use Dots\Distance\Position;
use Dotsplatform\LocationsApiSdk\DTO\LocationSource;

class Location extends Entity
{
    protected string $id;

    protected string $searchKey;

    protected string $geoCityId;

    protected string $address;

    protected string $city;

    protected ?string $street;

    protected ?string $number;

    protected ?string $zip;

    protected LocationSource $source;

    protected Position $location;

    public function getId(): string
    {
        return $this->id;
    }

    public function getSearchKey(): string
    {
        return $this->searchKey;
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

    public function getStreet(): ?string
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
