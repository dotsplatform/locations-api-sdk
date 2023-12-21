<?php
/**
 * Description of GetDistanceDataParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\App\Client\DTO\Params;

use Dots\Data\DTO;
use Dots\Distance\Position;

class GetDistanceDataParamsDTO extends DTO
{
    protected string $accountId;

    protected Position $source;

    protected Position $destination;

    protected array $transportTypes;

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

    public function getAccountId(): string
    {
        return $this->accountId;
    }
}
