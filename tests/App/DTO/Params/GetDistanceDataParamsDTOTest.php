<?php
/**
 * Description of GetDistanceDataParamsDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\DTO\Params;


use Dotsplatform\LocationsApiSdk\DTO\Params\GetDistanceDataParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\TransportType;
use Tests\TestCase;

class GetDistanceDataParamsDTOTest extends TestCase
{
    public function testExpectsData(): void
    {
        $data = [
            'source' => [
                'latitude' => 1,
                'longitude' => 2,
            ],
            'destination' => [
                'latitude' => 3,
                'longitude' => 4,
            ],
            'transportTypes' => [
                TransportType::BICYCLE->value,
                TransportType::PEDESTRIAN->value,
            ],
        ];

        $dto = GetDistanceDataParamsDTO::fromArray($data);

        $this->assertEquals($data['source']['latitude'], $dto->getSource()->getLatitude());
        $this->assertEquals($data['source']['longitude'], $dto->getSource()->getLongitude());
        $this->assertEquals($data['destination']['latitude'], $dto->getDestination()->getLatitude());
        $this->assertEquals($data['destination']['longitude'], $dto->getDestination()->getLongitude());
        $this->assertEquals($data['transportTypes'], $dto->getTransportTypes());
    }

    public function testToRequestData(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'source' => [
                'latitude' => 1,
                'longitude' => 2,
            ],
            'destination' => [
                'latitude' => 3,
                'longitude' => 4,
            ],
            'transportTypes' => [
                TransportType::BICYCLE->value,
                TransportType::PEDESTRIAN->value,
            ],
        ];

        $dto = GetDistanceDataParamsDTO::fromArray($data);
        $requestData = $dto->toRequestData();

        $this->assertEquals($data['source']['latitude'], $requestData['fromLatitude']);
        $this->assertEquals($data['source']['longitude'], $requestData['fromLongitude']);
        $this->assertEquals($data['destination']['latitude'], $requestData['toLatitude']);
        $this->assertEquals($data['destination']['longitude'], $requestData['toLongitude']);
        $this->assertEquals($data['transportTypes'], $requestData['transportTypes']);
    }
}