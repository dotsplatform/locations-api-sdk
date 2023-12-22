<?php
/**
 * Description of DistanceResultDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\DTO\Result;

use Dotsplatform\LocationsApiSdk\DTO\Results\DistanceResultDTO;
use Tests\TestCase;

class DistanceResultDTOTest extends TestCase
{
    public function testEmpty(): void
    {
        $dto = DistanceResultDTO::empty();
        $this->assertNull($dto->getDistance());
        $this->assertNull($dto->getDuration());
        $this->assertFalse($dto->isValid());
    }

    public function testExpectsData(): void
    {
        $data = [
            'distance' => 1,
            'duration' => 2,
        ];

        $dto = DistanceResultDTO::fromArray($data);
        $this->assertEquals($data['distance'], $dto->getDistance());
        $this->assertEquals($data['duration'], $dto->getDuration());
    }

    public function testExpectsInvalidIfEmptyDuration(): void
    {
        $data = [
            'distance' => 1,
            'duration' => null,
        ];

        $dto = DistanceResultDTO::fromArray($data);
        $this->assertFalse($dto->isValid());
    }

    public function testCreateNewObjectFromSelf(): void
    {
        $data = [
            'distance' => 1,
            'duration' => 2,
        ];

        $dto = DistanceResultDTO::fromArray(
            DistanceResultDTO::fromArray($data)->toArray(),
        );

        $this->assertEquals($data['distance'], $dto->getDistance());
    }
}
