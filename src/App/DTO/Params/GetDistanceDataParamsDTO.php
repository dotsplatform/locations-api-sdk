<?php
/**
 * Description of GetDistanceDataParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params;

use Dots\Data\DTO;
use Dots\Distance\Position;

class GetDistanceDataParamsDTO extends DTO
{
    protected Position $source;

    protected Position $destination;

    protected array $transportTypes;

    public static function fromArray(array $data): static
    {
        $data['source'] = Position::fromArray($data['source'] ?? []);
        $data['destination'] = Position::fromArray($data['destination'] ?? []);

        return parent::fromArray($data);
    }

    public function toRequestData(): array
    {
        return [
            'fromLatitude' => $this->getSource()->getLatitude(),
            'fromLongitude' => $this->getSource()->getLongitude(),
            'toLatitude' => $this->getDestination()->getLatitude(),
            'toLongitude' => $this->getDestination()->getLongitude(),
            'transportTypes' => $this->getTransportTypes(),
        ];
    }

    public function getSource(): Position
    {
        return $this->source;
    }

    public function getDestination(): Position
    {
        return $this->destination;
    }

    public function getTransportTypes(): array
    {
        return $this->transportTypes;
    }
}
