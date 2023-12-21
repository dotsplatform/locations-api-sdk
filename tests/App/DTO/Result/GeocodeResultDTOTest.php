<?php
/**
 * Description of GeocodeResultDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\DTO\Result;


use Dotsplatform\LocationsApiSdk\DTO\ProviderType;
use Dotsplatform\LocationsApiSdk\DTO\Results\GeocodeResultDTO;
use Tests\TestCase;

class GeocodeResultDTOTest extends TestCase
{
    public function testEmpty(): void
    {
        $dto = GeocodeResultDTO::empty();
        $this->assertNull($dto->getProvider());
        $this->assertNull($dto->getPosition());
        $this->assertNull($dto->getLatitude());
        $this->assertNull($dto->getLongitude());
        $this->assertFalse($dto->isValid());
    }

    public function testExpectsData(): void
    {
        $data = [
            'provider' => ProviderType::GOOGLE->value,
            'position' => [
                'latitude' => 1,
                'longitude' => 2,
            ],
        ];

        $dto = GeocodeResultDTO::fromArray($data);
        $this->assertEquals($data['provider'], $dto->getProvider()->value);
        $this->assertEquals($data['position']['latitude'], $dto->getPosition()->getLatitude());
        $this->assertEquals($data['position']['longitude'], $dto->getPosition()->getLongitude());
    }

    public function testExpectsInvalidIfEmptyLatitude(): void
    {
        $data = [
            'provider' => ProviderType::GOOGLE->value,
            'position' => [
                'latitude' => null,
                'longitude' => 2,
            ],
        ];

        $dto = GeocodeResultDTO::fromArray($data);
        $this->assertFalse($dto->isValid());
    }

    public function testExpectsInvalidIfEmptyLongitude(): void
    {
        $data = [
            'provider' => ProviderType::GOOGLE->value,
            'position' => [
                'latitude' => 1,
                'longitude' => null,
            ],
        ];

        $dto = GeocodeResultDTO::fromArray($data);
        $this->assertFalse($dto->isValid());
    }
}