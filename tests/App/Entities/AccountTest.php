<?php
/**
 * Description of AccountTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Entities;


use Dotsplatform\LocationsApiSdk\DTO\ProviderType;
use Dotsplatform\LocationsApiSdk\Entities\Account;
use Tests\TestCase;

class AccountTest extends TestCase
{
    public function testExpectsData(): void
    {
        $data = [
            'id' => $this->uuid(),
            'name' => $this->uuid(),
            'region' => $this->uuid(),
            'geoPositionProviderType' => ProviderType::HERE->value,
            'autocompleteProviderType' => ProviderType::GOOGLE->value,
            'routeDistancesProviderType' => ProviderType::GOOGLE->value,
        ];

        $dto = Account::fromArray($data);

        $this->assertEquals($data['id'], $dto->getId());
        $this->assertEquals($data['name'], $dto->getName());
        $this->assertEquals($data['region'], $dto->getRegion());
        $this->assertEquals($data['geoPositionProviderType'], $dto->getGeoPositionProviderType()->value);
        $this->assertEquals($data['autocompleteProviderType'], $dto->getAutocompleteProviderType()->value);
        $this->assertEquals($data['routeDistancesProviderType'], $dto->getRouteDistancesProviderType()->value);
    }

    public function testCreateNewObjectFromSelf(): void
    {
        $data = [
            'id' => $this->uuid(),
            'name' => $this->uuid(),
            'region' => $this->uuid(),
            'geoPositionProviderType' => ProviderType::HERE->value,
            'autocompleteProviderType' => ProviderType::GOOGLE->value,
            'routeDistancesProviderType' => ProviderType::GOOGLE->value,
        ];

        $dto = Account::fromArray(
            Account::fromArray($data)->toArray(),
        );

        $this->assertEquals($data['id'], $dto->getId());
        $this->assertEquals($data['name'], $dto->getName());
        $this->assertEquals($data['region'], $dto->getRegion());
        $this->assertEquals($data['geoPositionProviderType'], $dto->getGeoPositionProviderType()->value);
        $this->assertEquals($data['autocompleteProviderType'], $dto->getAutocompleteProviderType()->value);
        $this->assertEquals($data['routeDistancesProviderType'], $dto->getRouteDistancesProviderType()->value);
    }
}