<?php
/**
 * Description of PlaceDetailsDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Eduard Danylov <eduard.danylov@dotsplatform.com>
 */

namespace Tests\App\DTO\Result;

use Dotsplatform\LocationsApiSdk\DTO\Results\PlaceDetailsDTO;
use Tests\TestCase;

class PlaceDetailsDTOTest extends TestCase
{
    public function testExpectsEmpty(): void
    {
        $dto = PlaceDetailsDTO::empty();

        $this->assertFalse($dto->isAvailable());
        $this->assertNull($dto->getRating());
        $this->assertNull($dto->getUserRatingCount());
        $this->assertNull($dto->getGoogleMapsUri());
    }

    public function testCreatesFromLocationsResponse(): void
    {
        $dto = PlaceDetailsDTO::fromArray([
            'available' => true,
            'rating' => 4,
            'userRatingCount' => 120,
            'googleMapsUri' => 'https://maps.google.com/?cid=1',
        ]);

        $this->assertTrue($dto->isAvailable());
        $this->assertSame(4.0, $dto->getRating());
        $this->assertSame(120, $dto->getUserRatingCount());
        $this->assertSame('https://maps.google.com/?cid=1', $dto->getGoogleMapsUri());
    }
}
