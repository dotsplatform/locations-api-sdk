<?php

/**
 * Description of LocationsList.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Entities\Locations;

use Illuminate\Support\Collection;

/**
 * @extends Collection<int, Location>
 */
class LocationsList extends Collection
{
    public static function fromArray(array $data): static
    {
        return new static(array_map(
            fn (array $cityData) => Location::fromArray($cityData),
            $data,
        ));
    }
}
