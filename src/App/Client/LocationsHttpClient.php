<?php
/**
 * Description of LocationsHttpClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Client;

use Dotsplatform\LocationsApiSdk\DTO\Params\CheckPositionInPolygonParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\FilterPolygonsForPositionParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\GeocodeParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\GetBatchDistanceDataParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\GetDistanceDataParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\ReverseGeocodeParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\StoreProviderDTO;
use Dotsplatform\LocationsApiSdk\DTO\Params\UpdateGeocodeResultParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;
use Dotsplatform\LocationsApiSdk\DTO\Results\AutocompleteResponseDTO;
use Dotsplatform\LocationsApiSdk\DTO\Results\BatchDistanceResults;
use Dotsplatform\LocationsApiSdk\DTO\Results\DistanceResults;
use Dotsplatform\LocationsApiSdk\DTO\Results\GeocodeResultDTO;
use Dotsplatform\LocationsApiSdk\DTO\Results\ReverseGeocodeResultDTO;
use Dotsplatform\LocationsApiSdk\Entities\Account;
use Dotsplatform\LocationsApiSdk\Entities\City;
use Dotsplatform\LocationsApiSdk\Entities\GoogleProvider;
use Dotsplatform\LocationsApiSdk\Entities\HereProvider;
use Dotsplatform\LocationsApiSdk\Entities\Provider;
use Dotsplatform\LocationsApiSdk\Entities\VisicomProvider;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class LocationsHttpClient implements LocationsClient
{
    private const SHOW_ACCOUNT_URL_TEMPLATE = '/accounts/%s';

    private const STORE_ACCOUNT_URL_TEMPLATE = '/accounts';

    private const STORE_CITY_URL_TEMPLATE = '/accounts/%s/cities';

    private const DELETE_CITY_URL_TEMPLATE = '/accounts/%s/cities/%s';

    private const SHOW_PROVIDER_URL_TEMPLATE = '/accounts/%s/providers/%s';

    private const SHOW_AUTOCOMPLETE_DATA = '/accounts/%s/providers/autocomplete-data';

    private const STORE_PROVIDER_URL_TEMPLATE = '/accounts/%s/providers/%s';

    private const GEOCODE_URL_TEMPLATE = '/accounts/%s/geocode';

    private const REVERSE_GEOCODE_URL_TEMPLATE = '/accounts/%s/reverse-geocode';

    private const UPDATE_GEOCODE_RESULTS_URL_TEMPLATE = '/accounts/%s/geocode';

    private const DISTANCE_DATA_URL_TEMPLATE = '/accounts/%s/distance';

    private const BATCH_DISTANCE_DATA_URL_TEMPLATE = '/accounts/%s/distance/batch';

    private const CHECK_COORDINATES_IN_POLYGON_URL_TEMPLATE = '/accounts/%s/coordinates-for-polygon';

    private const FILTER_SUITABLE_POLYGONS_URL_TEMPLATE = '/accounts/%s/filter-polygons';

    public function storeAccount(Account $account): void
    {
        $url = $this->generateUrl(self::STORE_ACCOUNT_URL_TEMPLATE);
        try {
            $this->makeClient()->post($url, [
                'json' => $account->toArray(),
            ]);
        } catch (Exception|GuzzleException) {
            return;
        }
    }

    public function findAccount(string $accountId): ?Account
    {
        $url = $this->generateUrl(self::SHOW_ACCOUNT_URL_TEMPLATE, [
            $accountId,
        ]);

        try {
            $response = $this->makeClient()->get($url, [
            ]);
        } catch (Exception|GuzzleException) {
            return null;
        }
        $data = $this->decodeResponse($response);
        if (empty($data)) {
            return null;
        }

        return Account::fromArray($data);
    }

    public function storeCity(City $city): void
    {
        $url = $this->generateUrl(self::STORE_CITY_URL_TEMPLATE, [
            $city->getAccountId(),
        ]);
        try {
            $this->makeClient()->post($url, [
                'json' => $city->toArray(),
            ]);
        } catch (Exception|GuzzleException) {
            return;
        }
    }

    public function deleteCity(string $accountId, string $id): void
    {
        $url = $this->generateUrl(self::DELETE_CITY_URL_TEMPLATE, [
            $accountId,
            $id,
        ]);
        try {
            $this->makeClient()->delete($url);
        } catch (Exception|GuzzleException) {
            return;
        }
    }

    public function storeProvider(StoreProviderDTO $dto): void
    {
        $url = $this->generateUrl(self::STORE_PROVIDER_URL_TEMPLATE, [
            $dto->getAccountId(),
            $dto->getProviderType()->value,
        ]);
        try {
            $this->makeClient()->post($url, [
                'json' => $dto->toArray(),
            ]);
        } catch (Exception|GuzzleException) {
            return;
        }
    }

    public function findHereProvider(string $accountId): ?HereProvider
    {
        $provider = $this->findProvider($accountId, ProviderType::HERE->value);
        if (! $provider) {
            return null;
        }

        return HereProvider::fromProvider($provider);
    }

    public function findGoogleProvider(string $accountId): ?GoogleProvider
    {
        $provider = $this->findProvider($accountId, ProviderType::GOOGLE->value);
        if (! $provider) {
            return null;
        }

        return GoogleProvider::fromProvider($provider);
    }

    public function findVisicomProvider(string $accountId): ?VisicomProvider
    {
        $provider = $this->findProvider($accountId, ProviderType::VISICOM->value);
        if (! $provider) {
            return null;
        }

        return VisicomProvider::fromProvider($provider);
    }

    public function findProvider(string $accountId, string $providerType): ?Provider
    {
        $url = $this->generateUrl(self::SHOW_PROVIDER_URL_TEMPLATE, [
            $accountId,
            $providerType,
        ]);
        try {
            $response = $this->makeClient()->get($url);
        } catch (Exception|GuzzleException) {
            return null;
        }
        $data = $this->decodeResponse($response);
        if (empty($data)) {
            return null;
        }

        return Provider::fromArray($data);
    }

    public function autoCompleteData(string $accountId): AutocompleteResponseDTO
    {
        $url = $this->generateUrl(self::SHOW_AUTOCOMPLETE_DATA, [
            $accountId,
        ]);
        try {
            $response = $this->makeClient()->get($url);
        } catch (Exception|GuzzleException) {
            return AutocompleteResponseDTO::empty();
        }
        $data = $this->decodeResponse($response);
        if (empty($data)) {
            return AutocompleteResponseDTO::empty();
        }

        return AutocompleteResponseDTO::fromArray($data);
    }

    public function geocode(GeocodeParamsDTO $dto): GeocodeResultDTO
    {
        $url = $this->generateUrl(self::GEOCODE_URL_TEMPLATE, [
            $dto->getAccountId(),
        ]);

        try {
            $response = $this->makeClient()->get($url, [
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
            return GeocodeResultDTO::empty();
        }

        $data = $this->decodeResponse($response);
        if (empty($data)) {
            return GeocodeResultDTO::empty();
        }

        $data['position'] = [
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
        ];

        return GeocodeResultDTO::fromArray($data);
    }

    public function reverseGeocode(ReverseGeocodeParamsDTO $dto): ReverseGeocodeResultDTO
    {
        $url = $this->generateUrl(self::REVERSE_GEOCODE_URL_TEMPLATE, [
            $dto->getAccountId(),
        ]);

        try {
            $response = $this->makeClient()->get($url, [
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
            return ReverseGeocodeResultDTO::empty();
        }

        $data = $this->decodeResponse($response);
        if (empty($data)) {
            return ReverseGeocodeResultDTO::empty();
        }

        return ReverseGeocodeResultDTO::fromArray($data);
    }

    public function updateGeocodeResults(UpdateGeocodeResultParamsDTO $dto): void
    {
        $url = $this->generateUrl(self::UPDATE_GEOCODE_RESULTS_URL_TEMPLATE, [
            $dto->getAccountId(),
        ]);

        try {
            $this->makeClient()->put($url, [
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
        }
    }

    public function distanceData(string $accountId, GetDistanceDataParamsDTO $dto): DistanceResults
    {
        $url = $this->generateUrl(self::DISTANCE_DATA_URL_TEMPLATE, [
            $accountId,
        ]);

        try {
            $response = $this->makeClient()->get($url, [
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
            return DistanceResults::empty();
        }

        $data = $this->decodeResponse($response);
        if (empty($data)) {
            return DistanceResults::empty();
        }

        return DistanceResults::fromArray($data);
    }

    public function batchDistanceData(GetBatchDistanceDataParamsDTO $dto): BatchDistanceResults
    {
        $url = $this->generateUrl(self::BATCH_DISTANCE_DATA_URL_TEMPLATE, [
            $dto->getAccountId(),
        ]);

        try {
            $response = $this->makeClient()->post($url, [
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
            return BatchDistanceResults::empty();
        }

        $data = $this->decodeResponse($response);
        if (empty($data)) {
            return BatchDistanceResults::empty();
        }

        return BatchDistanceResults::fromArray($data);
    }

    public function isPositionInPolygon(CheckPositionInPolygonParamsDTO $dto): bool
    {
        $url = $this->generateUrl(self::CHECK_COORDINATES_IN_POLYGON_URL_TEMPLATE, [
            $dto->getAccountId(),
        ]);

        try {
            $response = $this->makeClient()->get($url, [
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
            return false;
        }

        $data = $this->decodeResponse($response);
        if (empty($data['valid'])) {
            return false;
        }

        return (bool) $data['valid'];
    }

    public function filterSuitablePolygons(FilterPolygonsForPositionParamsDTO $dto): array
    {
        $url = $this->generateUrl(self::FILTER_SUITABLE_POLYGONS_URL_TEMPLATE, [
            $dto->getAccountId(),
        ]);

        try {
            $response = $this->makeClient()->get($url, [
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
            return [];
        }

        return $this->decodeResponse($response);
    }

    private function generateUrl(string $template, array $params = []): string
    {
        return sprintf($template, ...$params);
    }

    private function makeClient(): Client
    {
        return new Client(
            [
                'base_uri' => config('locations-api-sdk.locations-server.host'),
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ],
        );
    }

    private function decodeResponse(ResponseInterface $response): array
    {
        $responseBody = (string) $response->getBody();
        $data = json_decode($responseBody, true);
        if (! is_array($data)) {
            return [];
        }

        return $data;
    }
}
