<?php
/**
 * Description of ReverseGeocodeParamsDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\DTO\Params;


use Dotsplatform\LocationsApiSdk\DTO\Params\ReverseGeocodeParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;
use Tests\TestCase;

class ReverseGeocodeParamsDTOTest extends TestCase
{
    public function testExpectsData(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'providerType' => ProviderType::GOOGLE->value,
            'position' => [
                'latitude' => 1,
                'longitude' => 2,
            ],
            'withoutCache' => true,
        ];

        $dto = ReverseGeocodeParamsDTO::fromArray($data);
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['providerType'], $dto->getProviderType()->value);
        $this->assertEquals($data['position']['latitude'], $dto->getPosition()->getLatitude());
        $this->assertEquals($data['position']['longitude'], $dto->getPosition()->getLongitude());
        $this->assertEquals($data['withoutCache'], $dto->withoutCache());
    }

    public function testExpectsDefaultData(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'position' => [
                'latitude' => 51,
                'longitude' => 31,
            ],
        ];

        $dto = ReverseGeocodeParamsDTO::fromArray($data);
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['position']['latitude'], $dto->getPosition()->getLatitude());
        $this->assertEquals($data['position']['longitude'], $dto->getPosition()->getLongitude());
        $this->assertNull($dto->getProviderType());
        $this->assertFalse($dto->withoutCache());
    }

    public function testToRequestData(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'providerType' => ProviderType::GOOGLE->value,
            'position' => [
                'latitude' => 1,
                'longitude' => 2,
            ],
            'withoutCache' => true,
        ];

        $dto = ReverseGeocodeParamsDTO::fromArray($data);
        $requestData = $dto->toRequestData();
        $this->assertEquals($data['providerType'], $requestData['providerType']);
        $this->assertEquals($data['position']['latitude'], $requestData['latitude']);
        $this->assertEquals($data['position']['longitude'], $requestData['longitude']);
        $this->assertEquals($data['withoutCache'], $requestData['withoutCache']);
    }
}