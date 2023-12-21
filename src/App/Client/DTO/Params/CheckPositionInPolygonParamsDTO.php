<?php
/**
 * Description of CheckCoordinatesInPolygonParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Client\DTO\Params;

use Dots\Data\DTO;
use Dots\Distance\Position;

class CheckPositionInPolygonParamsDTO extends DTO
{
    protected string $accountId;

    protected Position $position;

    protected array $polygon;

    public function toRequestData(): array
    {
        return [
            'polygon' => $this->getPolygon(),
            'coordinates' => [
                'latitude' => $this->getPosition()->getLatitude(),
                'longitude' => $this->getPosition()->getLongitude(),
            ],
        ];
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function getPolygon(): array
    {
        return $this->polygon;
    }
}
