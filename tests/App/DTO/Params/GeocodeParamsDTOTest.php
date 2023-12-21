<?php
/**
 * Description of GeocodeParamsDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\DTO\Params;


use Dotsplatform\LocationsApiSdk\DTO\Params\GeocodeParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;
use Tests\TestCase;

class GeocodeParamsDTOTest extends TestCase
{
    public function testExpectsData(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'address' => $this->uuid(),
            'providerType' => ProviderType::HERE,
            'withoutCache' => true,
        ];

        $dto = GeocodeParamsDTO::fromArray($data);
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['address'], $dto->getAddress());
        $this->assertEquals($data['providerType'], $dto->getProviderType());
        $this->assertEquals($data['withoutCache'], $dto->withoutCache());
    }

    public function testExpectsDefaultParamsFilled(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'address' => 'address',
        ];

        $dto = GeocodeParamsDTO::fromArray($data);
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['address'], $dto->getAddress());
        $this->assertNull($dto->getProviderType());
        $this->assertFalse($dto->withoutCache());
    }

    public function testToRequestDataExpectsData(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'address' => $this->uuid(),
            'providerType' => ProviderType::HERE,
            'withoutCache' => true,
        ];

        $dto = GeocodeParamsDTO::fromArray($data);
        $requestData = $dto->toRequestData();
        $this->assertEquals($data['withoutCache'], $requestData['withoutCache']);
        $this->assertEquals($data['address'], $requestData['address']);
        $this->assertEquals(ProviderType::HERE->value, $requestData['provider']);
    }
}