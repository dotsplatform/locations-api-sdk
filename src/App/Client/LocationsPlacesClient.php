<?php
/**
 * Description of LocationsPlacesClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Eduard Danylov <eduard.danylov@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Client;

use Dotsplatform\LocationsApiSdk\DTO\Results\PlaceDetailsDTO;

interface LocationsPlacesClient
{
    public function placeDetails(string $accountId, string $placeId): PlaceDetailsDTO;
}
