<?php
/**
 * Description of DistanceResultsTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\DTO\Result;


use Dotsplatform\LocationsApiSdk\DTO\Results\DistanceResults;
use Dotsplatform\LocationsApiSdk\DTO\TransportType;
use Tests\TestCase;

class DistanceResultsTest extends TestCase
{
    public function testExpectsData(): void
    {
        $data = [
            TransportType::CAR->value => [
                'distance' => 1,
                'duration' => 2,
            ],
            TransportType::BICYCLE->value => [
                'distance' => 3,
                'duration' => 4,
            ],
        ];

        $list = DistanceResults::fromArray($data);
        $this->assertEquals(
            $data[TransportType::CAR->value]['distance'],
            $list->get(TransportType::CAR->value)->getDistance(),
        );
        $this->assertEquals(
            $data[TransportType::CAR->value]['duration'],
            $list->get(TransportType::CAR->value)->getDuration(),
        );
        $this->assertEquals(
            $data[TransportType::BICYCLE->value]['distance'],
            $list->get(TransportType::BICYCLE->value)->getDistance(),
        );
        $this->assertEquals(
            $data[TransportType::BICYCLE->value]['duration'],
            $list->get(TransportType::BICYCLE->value)->getDuration(),
        );
    }

    public function testGetItemByTransportTypeExpectsNull(): void
    {
        $dto = DistanceResults::empty();
        $this->assertNull($dto->get(TransportType::CAR->value));
    }

    public function testGetItemByTransportTypeExpectsData(): void
    {
        $data = [
            TransportType::CAR->value => [
                'distance' => 1,
                'duration' => 2,
            ],
            TransportType::BICYCLE->value => [
                'distance' => 3,
                'duration' => 4,
            ],
            TransportType::PEDESTRIAN->value => [
                'distance' => 5,
                'duration' => 6,
            ],
        ];

        $list = DistanceResults::fromArray($data);
        $bicycleDistanceResult = $list->get(TransportType::BICYCLE->value);
        $this->assertEquals(
            $data[TransportType::BICYCLE->value]['distance'],
            $bicycleDistanceResult->getDistance(),
        );
        $this->assertEquals(
            $data[TransportType::BICYCLE->value]['duration'],
            $bicycleDistanceResult->getDuration(),
        );
    }
}