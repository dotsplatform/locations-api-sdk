<?php
/**
 * Description of GetDistanceDataParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params;

use Dots\Data\DTO;
use Dots\Distance\Position;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;

class GetDistanceDataParamsDTO extends DTO
{
    protected Position $source;

    protected Position $destination;

    protected array $transportTypes;

    protected ?ProviderType $providerType = null;

    public static function fromArray(array $data): static
    {
        $data['source'] = Position::fromArray($data['source'] ?? []);
        $data['destination'] = Position::fromArray($data['destination'] ?? []);
        if (! empty($data['providerType']) && ! $data['providerType'] instanceof ProviderType) {
            $data['providerType'] = ProviderType::from($data['providerType']);
        }

        return parent::fromArray($data);
    }

    public function toRequestData(): array
    {
        $data = [
            'fromLatitude' => $this->getSource()->getLatitude(),
            'fromLongitude' => $this->getSource()->getLongitude(),
            'toLatitude' => $this->getDestination()->getLatitude(),
            'toLongitude' => $this->getDestination()->getLongitude(),
            'transportTypes' => $this->getTransportTypes(),
        ];

        if ($this->getProviderType()) {
            $data['providerType'] = $this->getProviderType()->value;
        }

        return $data;
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

    public function getProviderType(): ?ProviderType
    {
        return $this->providerType;
    }
}
