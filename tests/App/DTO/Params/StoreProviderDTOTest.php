<?php
/**
 * Description of StoreProviderDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\DTO\Params;


use Dotsplatform\LocationsApiSdk\DTO\Params\StoreProviderDTO;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;
use Tests\TestCase;

class StoreProviderDTOTest extends TestCase
{
    public function testExpectsData(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'providerType' => ProviderType::HERE,
            'data' => [
                'geoPositionApiKeys' => [
                    $this->uuid(),
                    $this->uuid(),
                ],
            ],
        ];

        $dto = StoreProviderDTO::fromArray($data);

        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['providerType'], $dto->getProviderType());
        $this->assertEquals($data['data'], $dto->getData());
    }
}