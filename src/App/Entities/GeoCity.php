<?php

/**
 * Description of GeoCity.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Entities;

use Dots\Data\Entity;

class GeoCity extends Entity
{
    protected string $id;

    protected int $geoCountryId;

    protected string $name;

    protected string $url;

    public function getId(): string
    {
        return $this->id;
    }

    public function getGeoCountryId(): int
    {
        return $this->geoCountryId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
