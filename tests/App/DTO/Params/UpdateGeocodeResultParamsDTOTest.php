<?php
/**
 * Description of UpdateGeocodeResultParamsDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\DTO\Params;


use Dotsplatform\LocationsApiSdk\DTO\Params\UpdateGeocodeResultParamsDTO;
use Tests\TestCase;

class UpdateGeocodeResultParamsDTOTest extends TestCase
{
    public function testExpectsData(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'address' => $this->uuid(),
            'position' => [
                'latitude' => 1,
                'longitude' => 2,
            ],
        ];

        $dto = UpdateGeocodeResultParamsDTO::fromArray($data);
        $this->assertEquals($data['accountId'], $dto->getAccountId());
        $this->assertEquals($data['address'], $dto->getAddress());
        $this->assertEquals($data['position']['latitude'], $dto->getPosition()->getLatitude());
        $this->assertEquals($data['position']['longitude'], $dto->getPosition()->getLongitude());
    }

    public function testToRequestData(): void
    {
        $data = [
            'accountId' => $this->uuid(),
            'address' => $this->uuid(),
            'position' => [
                'latitude' => 1,
                'longitude' => 2,
            ],
        ];

        $dto = UpdateGeocodeResultParamsDTO::fromArray($data);
        $requestData = $dto->toRequestData();
        $this->assertEquals($data['address'], $requestData['address']);
        $this->assertEquals($data['position']['latitude'], $requestData['latitude']);
        $this->assertEquals($data['position']['longitude'], $requestData['longitude']);
    }
}