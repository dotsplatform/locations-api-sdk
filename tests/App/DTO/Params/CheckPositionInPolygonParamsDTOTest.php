<?php
/**
 * Description of CheckPositionInPolygonParamsDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\DTO\Params;


use Dotsplatform\LocationsApiSdk\DTO\Params\CheckPositionInPolygonParamsDTO;
use Illuminate\Support\Str;
use Tests\TestCase;

class CheckPositionInPolygonParamsDTOTest extends TestCase
{
    public function testExpectsOk(): void
    {
        $data = [
            'accountId' => Str::uuid()->toString(),
            'position' => [
                'latitude' => 50.4501,
                'longitude' => 30.5234,
            ],
            'polygon' => [
                [
                    'latitude' => 50.4501,
                    'longitude' => 30.5234,
                ],
                [
                    'latitude' => 50.4501,
                    'longitude' => 30.5234,
                ]
            ],
        ];

        $dto = CheckPositionInPolygonParamsDTO::fromArray($data);
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['position'], $dto->getPosition()->toArray());
        $this->assertEquals($data['polygon'], $dto->getPolygon());
    }

    public function testToRequestDataExpectsOk(): void
    {
        $data = [
            'accountId' => Str::uuid()->toString(),
            'position' => [
                'latitude' => 50.4501,
                'longitude' => 30.5234,
            ],
            'polygon' => [
                [
                    'latitude' => 50.4501,
                    'longitude' => 30.5234,
                ],
                [
                    'latitude' => 50.4501,
                    'longitude' => 30.5234,
                ]
            ],
        ];

        $dto = CheckPositionInPolygonParamsDTO::fromArray($data);
        $requestData = $dto->toRequestData();
        $this->assertEquals($data['polygon'], $requestData['polygon']);
        $this->assertEquals($data['position']['latitude'], $requestData['coordinates']['latitude']);
        $this->assertEquals($data['position']['longitude'], $requestData['coordinates']['longitude']);
    }
}