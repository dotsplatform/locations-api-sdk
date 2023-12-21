<?php
/**
 * Description of LocationsClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\App\Client;


use Dotsplatform\LocationsApiSdk\App\Client\DTO\Params\CheckPositionInPolygonParamsDTO;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Params\FilterPolygonsForPositionParamsDTO;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Params\GeocodeParamsDTO;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Params\GetBatchDistanceDataParamsDTO;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Params\GetDistanceDataParamsDTO;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Params\ReverseGeocodeParamsDTO;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Params\StoreProviderDTO;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Params\UpdateGeocodeResultParamsDTO;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Results\BatchDistanceResultsDTOs;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Results\DistanceResultsDTOs;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Results\GeocodeResultDTO;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Results\ReverseGeocodeResultDTO;
use Dotsplatform\LocationsApiSdk\App\Client\Entities\Account;
use Dotsplatform\LocationsApiSdk\App\Client\Entities\Provider;

interface LocationsClient
{
    public function storeAccount(Account $account): void;

    public function findAccount(string $accountId): ?Account;

    public function storeProvider(StoreProviderDTO $dto): void;

    public function findHereProvider(string $accountId): ?Provider;

    public function findGoogleProvider(string $accountId): ?Provider;

    public function findProvider(string $accountId, string $providerType): ?Provider;

    public function geocode(GeocodeParamsDTO $dto): GeocodeResultDTO;

    public function reverseGeocode(ReverseGeocodeParamsDTO $dto): ReverseGeocodeResultDTO;

    public function updateGeocodeResults(UpdateGeocodeResultParamsDTO $dto): void;

    public function distanceData(GetDistanceDataParamsDTO $dto): DistanceResultsDTOs;

    public function batchDistanceData(GetBatchDistanceDataParamsDTO $dto): BatchDistanceResultsDTOs;

    public function isPositionInPolygon(CheckPositionInPolygonParamsDTO $dto): bool;

    public function filterSuitablePolygons(FilterPolygonsForPositionParamsDTO $dto): array;
}