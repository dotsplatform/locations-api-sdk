<?php

/**
 * Description of SearchLocationsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params\Locations;

use Dots\Data\DTO;
use Dots\Distance\Position;
use Dotsplatform\LocationsApiSdk\DTO\LocationSource;

class SearchLocationsDTO extends DTO
{
    protected string $geoCityId;

    protected ?string $address;

    protected ?Position $position;

    protected ?LocationSource $source;

    protected int $radius = 20;

    protected int $limit = 50;

    protected int $offset = 0;

    public static function fromArray(array $data): static
    {
        if (isset($data['position'])) {
            $data['position'] = Position::fromArray($data['position']);
        }

        return parent::fromArray($data);
    }

    public function getGeoCityId(): string
    {
        return $this->geoCityId;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function getSource(): ?LocationSource
    {
        return $this->source;
    }

    public function getRadius(): int
    {
        return $this->radius;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
