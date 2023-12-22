<?php
/**
 * Description of GeocodeResultDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Results;

use Dots\Data\DTO;
use Dots\Distance\Position;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;

class GeocodeResultDTO extends DTO
{
    protected ?ProviderType $provider;

    protected ?Position $position;

    public static function fromArray(array $data): static
    {
        if (! empty($data['provider'])) {
            $data['provider'] = ProviderType::from($data['provider']);
        }
        if (! empty($data['position'])) {
            $data['position'] = Position::fromArray($data['position']);
        }

        return parent::fromArray($data);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['provider'] = $this->getProvider()?->value;

        return $data;
    }

    public function getProvider(): ?ProviderType
    {
        return $this->provider;
    }

    public function getLatitude(): ?float
    {
        return $this->getPosition()?->getLatitude();
    }

    public function getLongitude(): ?float
    {
        return $this->getPosition()?->getLongitude();
    }

    public function isValid(): bool
    {
        return (bool) $this->getPosition()?->isValid();
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }
}
