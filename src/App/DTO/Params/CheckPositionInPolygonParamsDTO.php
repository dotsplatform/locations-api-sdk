<?php
/**
 * Description of CheckCoordinatesInPolygonParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params;

use Dots\Data\DTO;
use Dots\Distance\Position;

class CheckPositionInPolygonParamsDTO extends DTO
{
    protected string $accountId;

    protected Position $position;

    protected array $polygon;

    public static function fromArray(array $data): static
    {
        $data['position'] = Position::fromArray($data['position'] ?? []);

        return parent::fromArray($data);
    }

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
