<?php
/**
 * Description of PlaceDetailsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Eduard Danylov <eduard.danylov@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Results;

use Dots\Data\DTO;

class PlaceDetailsDTO extends DTO
{
    protected bool $available = false;

    protected ?float $rating = null;

    protected ?int $userRatingCount = null;

    protected ?string $googleMapsUri = null;

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function getUserRatingCount(): ?int
    {
        return $this->userRatingCount;
    }

    public function getGoogleMapsUri(): ?string
    {
        return $this->googleMapsUri;
    }
}
