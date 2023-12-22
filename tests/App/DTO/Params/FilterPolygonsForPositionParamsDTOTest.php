<?php
/**
 * Description of FilterPolygonsForPositionParamsDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\DTO\Params;

use Dotsplatform\LocationsApiSdk\DTO\Params\FilterPolygonsForPositionParamsDTO;
use Illuminate\Support\Str;
use Tests\TestCase;

class FilterPolygonsForPositionParamsDTOTest extends TestCase
{
    public function testExpectsOk(): void
    {
        $data = [
            'accountId' => Str::uuid()->toString(),
            'position' => [
                'latitude' => 50.4501,
                'longitude' => 30.5234,
            ],
            'polygons' => [
                $this->generatePolygon(),
                $this->generatePolygon(),
            ],
        ];

        $dto = FilterPolygonsForPositionParamsDTO::fromArray($data);
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['position'], $dto->getPosition()->toArray());
        $this->assertEquals($data['polygons'], $dto->getPolygons());
    }

    public function testToRequestDataExpectsOk(): void
    {
        $data = [
            'accountId' => Str::uuid()->toString(),
            'position' => [
                'latitude' => 50.4501,
                'longitude' => 30.5234,
            ],
            'polygons' => [
                $this->generatePolygon(),
                $this->generatePolygon(),

            ],
        ];

        $dto = FilterPolygonsForPositionParamsDTO::fromArray($data);
        $requestData = $dto->toRequestData();
        $this->assertEquals($data['polygons'], $requestData['polygons']);
        $this->assertEquals($data['position']['latitude'], $requestData['coordinates']['latitude']);
        $this->assertEquals($data['position']['longitude'], $requestData['coordinates']['longitude']);
    }

    public function testCreateNewObjectFromSelf(): void
    {
        $data = [
            'accountId' => Str::uuid()->toString(),
            'position' => [
                'latitude' => 50.4501,
                'longitude' => 30.5234,
            ],
            'polygons' => [
                $this->generatePolygon(),
                $this->generatePolygon(),
            ],
        ];

        $dto = FilterPolygonsForPositionParamsDTO::fromArray($data);
        $dto = FilterPolygonsForPositionParamsDTO::fromArray($dto->toArray());
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['position'], $dto->getPosition()->toArray());
        $this->assertEquals($data['polygons'], $dto->getPolygons());
    }

    private function generatePolygon(): array
    {
        return [
            [
                'latitude' => 50.4501,
                'longitude' => 30.5234,
            ],
            [
                'latitude' => 50.4501,
                'longitude' => 30.5234,
            ],
        ];
    }
}
