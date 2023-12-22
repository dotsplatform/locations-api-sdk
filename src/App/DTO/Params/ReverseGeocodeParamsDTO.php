<?php
/**
 * Description of ReverseGeocodeParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params;

use Dots\Data\DTO;
use Dots\Distance\Position;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;

class ReverseGeocodeParamsDTO extends DTO
{
    protected string $accountId;

    protected ?ProviderType $providerType = null;

    protected Position $position;

    protected bool $withoutCache = false;

    public static function fromArray(array $data): static
    {
        $data['position'] = Position::fromArray($data['position'] ?? []);
        if (! empty($data['providerType'])) {
            $data['providerType'] = ProviderType::from($data['providerType']);
        }

        return parent::fromArray($data);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['providerType'] = $this->getProviderType()?->value;

        return $data;
    }

    public function toRequestData(): array
    {
        return [
            'withoutCache' => $this->withoutCache(),
            'providerType' => $this->getProviderType()?->value,
            'latitude' => $this->position->getLatitude(),
            'longitude' => $this->position->getLongitude(),
        ];
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getProviderType(): ?ProviderType
    {
        return $this->providerType;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function withoutCache(): bool
    {
        return $this->withoutCache;
    }
}
