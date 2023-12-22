<?php
/**
 * Description of BatchDistanceResultsTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\DTO\Result;

use Dotsplatform\LocationsApiSdk\DTO\Results\BatchDistanceResults;
use Dotsplatform\LocationsApiSdk\DTO\Results\DistanceResultDTO;
use Dotsplatform\LocationsApiSdk\DTO\Results\DistanceResults;
use Dotsplatform\LocationsApiSdk\DTO\TransportType;
use Tests\TestCase;

class BatchDistanceResultsTest extends TestCase
{
    public function testExpectsEmptyKeys(): void
    {
        $distanceResults1 = DistanceResults::fromArray([
            TransportType::CAR->value => $this->generateDistanceResult()->toArray(),
            TransportType::BICYCLE->value => $this->generateDistanceResult()->toArray(),
        ]);
        $distanceResults2 = DistanceResults::fromArray([
            TransportType::PEDESTRIAN->value => $this->generateDistanceResult()->toArray(),
        ]);

        $list = BatchDistanceResults::fromArray([
            $distanceResults1->toArray(),
            $distanceResults2->toArray(),
        ]);

        $this->assertEquals(
            $distanceResults1->toArray(),
            $list->getItemByKey(0)->toArray(),
        );

        $this->assertEquals(
            $distanceResults2->toArray(),
            $list->getItemByKey(1)->toArray(),
        );
    }

    public function testExpectsDataWithKeys(): void
    {
        $distanceResults1 = DistanceResults::fromArray([
            TransportType::CAR->value => $this->generateDistanceResult()->toArray(),
            TransportType::BICYCLE->value => $this->generateDistanceResult()->toArray(),
        ]);
        $distanceResults2 = DistanceResults::fromArray([
            TransportType::PEDESTRIAN->value => $this->generateDistanceResult()->toArray(),
        ]);

        $list = BatchDistanceResults::fromArray([
            'key1' => $distanceResults1->toArray(),
            'key2' => $distanceResults2->toArray(),
        ]);

        $this->assertEquals(
            $distanceResults1->toArray(),
            $list->getItemByKey('key1')->toArray(),
        );

        $this->assertEquals(
            $distanceResults2->toArray(),
            $list->getItemByKey('key2')->toArray(),
        );
    }

    public function testCreateNewObjectFromSelf(): void
    {
        $distanceResults1 = DistanceResults::fromArray([
            TransportType::PEDESTRIAN->value => $this->generateDistanceResult()->toArray(),
        ]);

        $list = BatchDistanceResults::fromArray([
            'key1' => $distanceResults1->toArray(),
        ]);
        $list = BatchDistanceResults::fromArray($list->toArray());

        $this->assertEquals(
            $distanceResults1->toArray(),
            $list->getItemByKey('key1')->toArray(),
        );
    }

    private function generateDistanceResult(): DistanceResultDTO
    {
        return DistanceResultDTO::fromArray([
            'distance' => rand(1, 100),
            'duration' => rand(1, 100),
        ]);
    }
}
