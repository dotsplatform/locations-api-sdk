<?php

/**
 * Description of SearchLocationsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace App\Services\Locations\DTO;

use App\Services\Locations\Enums\LocationSource;
use Dots\Data\DTO;
use Dots\Distance\Position;

class SearchLocationsDTO extends DTO
{
    protected string $geoCityId;

    protected ?string $address;

    protected ?Position $location;

    protected ?LocationSource $source;

    protected int $radius = 20;

    protected int $limit = 50;

    protected int $offset = 0;

    public static function fromArray(array $data): static
    {
        if (isset($data['location'])) {
            $data['location'] = Position::fromArray($data['location']);
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

    public function getLocation(): ?Position
    {
        return $this->location;
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
