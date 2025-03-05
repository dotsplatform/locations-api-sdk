<?php
/**
 * Description of LocationsClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Client;

use Dotsplatform\LocationsApiSdk\DTO\Params\CheckPositionInPolygonParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\FilterPolygonsForPositionParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\GeocodeParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\GetBatchDistanceDataParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\GetDistanceDataParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\Locations\SearchLocationsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\Locations\StoreLocationDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\ReverseGeocodeParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\StoreProviderDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\UpdateGeocodeResultParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Results\AutocompleteResponseDTO;
use Dotsplatform\LocationsApiSdk\DTO\Results\BatchDistanceResults;
use Dotsplatform\LocationsApiSdk\DTO\Results\DistanceResults;
use Dotsplatform\LocationsApiSdk\DTO\Results\GeocodeResultDTO;
use Dotsplatform\LocationsApiSdk\DTO\Results\ReverseGeocodeResultDTO;
use Dotsplatform\LocationsApiSdk\Entities\Account;
use Dotsplatform\LocationsApiSdk\Entities\City;
use Dotsplatform\LocationsApiSdk\Entities\GeoCity;
use Dotsplatform\LocationsApiSdk\Entities\GoogleProvider;
use Dotsplatform\LocationsApiSdk\Entities\HereProvider;
use Dotsplatform\LocationsApiSdk\Entities\Locations\Location;
use Dotsplatform\LocationsApiSdk\Entities\Locations\LocationsList;
use Dotsplatform\LocationsApiSdk\Entities\Provider;
use Dotsplatform\LocationsApiSdk\Entities\VisicomProvider;

interface LocationsClient
{
    public function storeAccount(Account $account): void;

    public function findAccount(string $accountId): ?Account;

    public function storeGeoCity(GeoCity $geoCity): void;

    public function searchLocations(SearchLocationsDTO $dto): LocationsList;

    public function findLocation(string $id): ?Location;

    public function createLocation(StoreLocationDTO $dto): ?string;

    public function updateLocation(string $id, StoreLocationDTO $dto): ?string;

    public function deleteLocation(string $id): void;

    public function storeCity(City $city): void;

    public function deleteCity(string $accountId, string $id): void;

    public function storeProvider(StoreProviderDTO $dto): void;

    public function findHereProvider(string $accountId): ?HereProvider;

    public function findGoogleProvider(string $accountId): ?GoogleProvider;

    public function findVisicomProvider(string $accountId): ?VisicomProvider;

    public function findProvider(string $accountId, string $providerType): ?Provider;

    public function autoCompleteData(string $accountId): AutocompleteResponseDTO;

    public function geocode(GeocodeParamsDTO $dto): GeocodeResultDTO;

    public function reverseGeocode(ReverseGeocodeParamsDTO $dto): ReverseGeocodeResultDTO;

    public function updateGeocodeResults(UpdateGeocodeResultParamsDTO $dto): void;

    public function distanceData(string $accountId, GetDistanceDataParamsDTO $dto): DistanceResults;

    public function batchDistanceData(GetBatchDistanceDataParamsDTO $dto): BatchDistanceResults;

    public function isPositionInPolygon(CheckPositionInPolygonParamsDTO $dto): bool;

    public function filterSuitablePolygons(FilterPolygonsForPositionParamsDTO $dto): array;
}
