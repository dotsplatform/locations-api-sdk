<?php
/**
 * Description of LocationsHttpClient.php
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
use Dotsplatform\LocationsApiSdk\App\Client\DTO\ProviderType;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Results\BatchDistanceResultsDTOs;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Results\DistanceResultsDTOs;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Results\GeocodeResultDTO;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\Results\ReverseGeocodeResultDTO;
use Dotsplatform\LocationsApiSdk\App\Client\Entities\Account;
use Dotsplatform\LocationsApiSdk\App\Client\Entities\Provider;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class LocationsHttpClient implements LocationsClient
{
    private const SHOW_ACCOUNT_URL_TEMPLATE = '/accounts/%s';

    private const STORE_ACCOUNT_URL_TEMPLATE = '/accounts';

    private const SHOW_PROVIDER_URL_TEMPLATE = '/accounts/%s/providers/%s';

    private const STORE_PROVIDER_URL_TEMPLATE = '/accounts/%s/providers';

    private const GEOCODE_URL_TEMPLATE = '/accounts/%s/geocode';

    private const REVERSE_GEOCODE_URL_TEMPLATE = '/accounts/%s/reverse-geocode';

    private const UPDATE_GEOCODE_RESULTS_URL_TEMPLATE = '/accounts/%s/geocode';

    private const DISTANCE_DATA_URL_TEMPLATE = '/accounts/%s/distance';

    private const BATCH_DISTANCE_DATA_URL_TEMPLATE = '/accounts/%s/distance/batch';

    private const CHECK_COORDINATES_IN_POLYGON_URL_TEMPLATE = '/accounts/%s/coordinates-for-polygon';

    private const FILTER_SUITABLE_POLYGONS_URL_TEMPLATE = '/accounts/%s/filter-polygons';

    public function __construct(
        private readonly string $serviceHost,
        private readonly Client $client,
    ) {
    }

    public function storeAccount(Account $account): void
    {
        $url = $this->generateUrl(self::STORE_ACCOUNT_URL_TEMPLATE);
        try {
            $this->client->post($url, [
                'headers' => $this->getDefaultHeaders(),
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
            $response = $this->client->get($url, [
                'headers' => $this->getDefaultHeaders(),
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

    public function storeProvider(StoreProviderDTO $dto): void
    {
        $url = $this->generateUrl(self::STORE_PROVIDER_URL_TEMPLATE, [
            $dto->getAccountId(),
            $dto->getProviderType()->value,
        ]);
        try {
            $this->client->post($url, [
                'headers' => $this->getDefaultHeaders(),
                'json' => $dto->toArray(),
            ]);
        } catch (Exception|GuzzleException) {
            return;
        }
    }

    public function findHereProvider(string $accountId): ?Provider
    {
        return $this->findProvider($accountId, ProviderType::HERE->value);
    }

    public function findGoogleProvider(string $accountId): ?Provider
    {
        return $this->findProvider($accountId, ProviderType::GOOGLE->value);
    }

    public function findProvider(string $accountId, string $providerType): ?Provider
    {
        $url = $this->generateUrl(self::SHOW_PROVIDER_URL_TEMPLATE, [
            $accountId,
            $providerType,
        ]);
        try {
            $response = $this->client->get($url, [
                'headers' => $this->getDefaultHeaders(),
            ]);
        } catch (Exception|GuzzleException) {
            return null;
        }
        $data = $this->decodeResponse($response);
        if (empty($data)) {
            return null;
        }

        return Provider::fromArray($data);
    }

    public function geocode(GeocodeParamsDTO $dto): GeocodeResultDTO
    {
        $url = $this->generateUrl(self::GEOCODE_URL_TEMPLATE, [
            $dto->getAccountId(),
        ]);

        try {
            $response = $this->client->get($url, [
                'headers' => $this->getDefaultHeaders(),
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
            $response = $this->client->get($url, [
                'headers' => $this->getDefaultHeaders(),
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
            $this->client->get($url, [
                'headers' => $this->getDefaultHeaders(),
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
        }
    }

    public function distanceData(GetDistanceDataParamsDTO $dto): DistanceResultsDTOs
    {
        $url = $this->generateUrl(self::DISTANCE_DATA_URL_TEMPLATE, [
            $dto->getAccountId(),
        ]);

        try {
            $response = $this->client->get($url, [
                'headers' => $this->getDefaultHeaders(),
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
            return DistanceResultsDTOs::empty();
        }

        $data = $this->decodeResponse($response);
        if (empty($data)) {
            return DistanceResultsDTOs::empty();
        }

        return DistanceResultsDTOs::fromArray($data);
    }

    public function batchDistanceData(GetBatchDistanceDataParamsDTO $dto): BatchDistanceResultsDTOs
    {
        $url = $this->generateUrl(self::BATCH_DISTANCE_DATA_URL_TEMPLATE, [
            $dto->getAccountId(),
        ]);

        try {
            $response = $this->client->get($url, [
                'headers' => $this->getDefaultHeaders(),
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
            return BatchDistanceResultsDTOs::empty();
        }

        $data = $this->decodeResponse($response);
        if (empty($data)) {
            return BatchDistanceResultsDTOs::empty();
        }

        return BatchDistanceResultsDTOs::fromArray($data);
    }

    public function isPositionInPolygon(CheckPositionInPolygonParamsDTO $dto): bool
    {
        $url = $this->generateUrl(self::CHECK_COORDINATES_IN_POLYGON_URL_TEMPLATE, [
            $dto->getAccountId(),
        ]);

        try {
            $response = $this->client->get($url, [
                'headers' => $this->getDefaultHeaders(),
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
            $response = $this->client->get($url, [
                'headers' => $this->getDefaultHeaders(),
                'json' => $dto->toRequestData(),
            ]);
        } catch (Exception|GuzzleException) {
            return [];
        }

        return $this->decodeResponse($response);
    }

    private function generateUrl(string $template, array $params = []): string
    {
        return $this->serviceHost.sprintf($template, ...$params);
    }

    private function getDefaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
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
