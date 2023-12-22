<?php
/**
 * Description of ProviderTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Entities;


use Dotsplatform\LocationsApiSdk\DTO\ProviderType;
use Dotsplatform\LocationsApiSdk\Entities\Provider;
use Tests\TestCase;

class ProviderTest extends TestCase
{
    public function testExpectsData(): void
    {
        $data = [
            'id' => $this->uuid(),
            'accountId' => $this->uuid(),
            'type' => ProviderType::HERE->value,
            'data' => [
                'geoPositionApiKeys' => [
                    $this->uuid(),
                ],
                'routeApiKeys' => [
                    $this->uuid(),
                    $this->uuid(),
                    $this->uuid(),
                ],
                'autocompleteApiKeys' => [
                    $this->uuid(),
                    $this->uuid(),
                ],
            ],
        ];

        $dto = Provider::fromArray($data);

        $this->assertEquals($data['id'], $dto->getId());
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['type'], $dto->getType()->value);
        $this->assertEquals($data['data'], $dto->getData());
    }

    public function testCreateNewObjectFromSelf(): void
    {
        $data = [
            'id' => $this->uuid(),
            'accountId' => $this->uuid(),
            'type' => ProviderType::HERE->value,
            'data' => [
                'geoPositionApiKeys' => [
                    $this->uuid(),
                ],
                'routeApiKeys' => [
                    $this->uuid(),
                    $this->uuid(),
                    $this->uuid(),
                ],
                'autocompleteApiKeys' => [
                    $this->uuid(),
                    $this->uuid(),
                ],
            ],
        ];

        $dto = Provider::fromArray(
            Provider::fromArray($data)->toArray(),
        );

        $this->assertEquals($data['id'], $dto->getId());
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['type'], $dto->getType()->value);
        $this->assertEquals($data['data'], $dto->getData());
    }
}