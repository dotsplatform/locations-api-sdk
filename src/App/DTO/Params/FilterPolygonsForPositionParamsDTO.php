<?php
/**
 * Description of FilterSuitablePolygonsForCoordinatesParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params;

use Dots\Data\DTO;
use Dots\Distance\Position;

class FilterPolygonsForPositionParamsDTO extends DTO
{
    protected string $accountId;

    protected Position $position;

    protected array $polygons;

    public function toRequestData(): array
    {
        return [
            'polygons' => $this->getPolygons(),
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

    public function getPolygons(): array
    {
        return $this->polygons;
    }
}
