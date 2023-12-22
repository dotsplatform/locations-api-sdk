<?php
/**
 * Description of ReverseGeocodeResultDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\DTO\Result;

use Dotsplatform\LocationsApiSdk\DTO\ProviderType;
use Dotsplatform\LocationsApiSdk\DTO\Results\ReverseGeocodeResultDTO;
use Tests\TestCase;

class ReverseGeocodeResultDTOTest extends TestCase
{
    public function testEmpty(): void
    {
        $dto = ReverseGeocodeResultDTO::empty();
        $this->assertNull($dto->getProvider());
        $this->assertNull($dto->getAddress());
        $this->assertNull($dto->getCountry());
        $this->assertNull($dto->getCity());
        $this->assertNull($dto->getCityId());
        $this->assertNull($dto->getStreet());
        $this->assertNull($dto->getNumber());
        $this->assertFalse($dto->isValid());
    }

    public function testExpectsData(): void
    {
        $data = [
            'provider' => ProviderType::GOOGLE->value,
            'address' => 'address',
            'country' => 'country',
            'city' => 'city',
            'city_id' => 'city_id',
            'street' => 'street',
            'number' => 'number',
        ];

        $dto = ReverseGeocodeResultDTO::fromArray($data);
        $this->assertEquals($data['provider'], $dto->getProvider()->value);
        $this->assertEquals($data['address'], $dto->getAddress());
        $this->assertEquals($data['country'], $dto->getCountry());
        $this->assertEquals($data['city'], $dto->getCity());
        $this->assertEquals($data['city_id'], $dto->getCityId());
        $this->assertEquals($data['street'], $dto->getStreet());
        $this->assertEquals($data['number'], $dto->getNumber());
    }

    public function testExpectsInvalidIfEmptyAddress(): void
    {
        $data = [
            'provider' => ProviderType::GOOGLE->value,
            'address' => null,
            'country' => 'country',
            'city' => 'city',
            'city_id' => 'city_id',
            'street' => 'street',
            'number' => 'number',
        ];

        $dto = ReverseGeocodeResultDTO::fromArray($data);
        $this->assertFalse($dto->isValid());
    }

    public function testCreateNewObjectFromSelf(): void
    {
        $data = [
            'provider' => ProviderType::GOOGLE->value,
            'address' => 'address',
            'country' => 'country',
            'city' => 'city',
            'city_id' => 'city_id',
            'street' => 'street',
            'number' => 'number',
        ];

        $dto = ReverseGeocodeResultDTO::fromArray(
            ReverseGeocodeResultDTO::fromArray($data)->toArray(),
        );

        $this->assertEquals($data['address'], $dto->getAddress());
    }
}
