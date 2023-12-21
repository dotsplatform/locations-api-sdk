<?php
/**
 * Description of DistanceResultDTO.php.
 *
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace Dotsplatform\LocationsApiSdk\Client\DTO\Results;

use Dots\Data\DTO;

class DistanceResultDTO extends DTO
{
    protected ?float $distance;

    protected ?float $duration;

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function isValid(): bool
    {
        return ! empty($this->getDuration());
    }
}
