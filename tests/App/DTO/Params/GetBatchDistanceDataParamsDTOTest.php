<?php
/**
 * Description of GetBatchDistanceDataParamsDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\DTO\Params;

use Dotsplatform\LocationsApiSdk\DTO\Params\GetBatchDistanceDataParamsDTO;
use Dotsplatform\LocationsApiSdk\DTO\TransportType;
use Tests\TestCase;

class GetBatchDistanceDataParamsDTOTest extends TestCase
{
    public function testExpectsData(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'items' => [
                [
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
                ],
                [
                    'source' => [
                        'latitude' => 5,
                        'longitude' => 6,
                    ],
                    'destination' => [
                        'latitude' => 7,
                        'longitude' => 8,
                    ],
                    'transportTypes' => [
                        TransportType::CAR->value,
                    ],
                ],
            ],
        ];

        $dto = GetBatchDistanceDataParamsDTO::fromArray($data);
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['items'][0]['source']['latitude'], $dto->getItems()[0]->getSource()->getLatitude());
        $this->assertEquals($data['items'][0]['source']['longitude'], $dto->getItems()[0]->getSource()->getLongitude());
        $this->assertEquals($data['items'][0]['destination']['latitude'], $dto->getItems()[0]->getDestination()->getLatitude());
        $this->assertEquals($data['items'][0]['destination']['longitude'], $dto->getItems()[0]->getDestination()->getLongitude());
        $this->assertEquals($data['items'][0]['transportTypes'], $dto->getItems()[0]->getTransportTypes());
        $this->assertEquals($data['items'][1]['source']['latitude'], $dto->getItems()[1]->getSource()->getLatitude());
        $this->assertEquals($data['items'][1]['source']['longitude'], $dto->getItems()[1]->getSource()->getLongitude());
        $this->assertEquals($data['items'][1]['destination']['latitude'], $dto->getItems()[1]->getDestination()->getLatitude());
        $this->assertEquals($data['items'][1]['destination']['longitude'], $dto->getItems()[1]->getDestination()->getLongitude());
        $this->assertEquals($data['items'][1]['transportTypes'], $dto->getItems()[1]->getTransportTypes());
    }

    public function testCreateNewObjectFromSelf(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'items' => [
                [
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
                ],
                [
                    'source' => [
                        'latitude' => 5,
                        'longitude' => 6,
                    ],
                    'destination' => [
                        'latitude' => 7,
                        'longitude' => 8,
                    ],
                    'transportTypes' => [
                        TransportType::CAR->value,
                    ],
                ],
            ],
        ];

        $dto = GetBatchDistanceDataParamsDTO::fromArray($data);
        $dto = GetBatchDistanceDataParamsDTO::fromArray($dto->toArray());
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['items'][0]['source']['latitude'], $dto->getItems()[0]->getSource()->getLatitude());
        $this->assertEquals($data['items'][0]['source']['longitude'], $dto->getItems()[0]->getSource()->getLongitude());
        $this->assertEquals($data['items'][0]['destination']['latitude'], $dto->getItems()[0]->getDestination()->getLatitude());
        $this->assertEquals($data['items'][0]['destination']['longitude'], $dto->getItems()[0]->getDestination()->getLongitude());
        $this->assertEquals($data['items'][0]['transportTypes'], $dto->getItems()[0]->getTransportTypes());
        $this->assertEquals($data['items'][1]['source']['latitude'], $dto->getItems()[1]->getSource()->getLatitude());
        $this->assertEquals($data['items'][1]['source']['longitude'], $dto->getItems()[1]->getSource()->getLongitude());
        $this->assertEquals($data['items'][1]['destination']['latitude'], $dto->getItems()[1]->getDestination()->getLatitude());
        $this->assertEquals($data['items'][1]['destination']['longitude'], $dto->getItems()[1]->getDestination()->getLongitude());
        $this->assertEquals($data['items'][1]['transportTypes'], $dto->getItems()[1]->getTransportTypes());
    }
}
