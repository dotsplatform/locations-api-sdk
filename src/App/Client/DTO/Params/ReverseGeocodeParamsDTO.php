<?php
/**
 * Description of ReverseGeocodeParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\App\Client\DTO\Params;

use Dots\Data\DTO;
use Dots\Distance\Position;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\ProviderType;

class ReverseGeocodeParamsDTO extends DTO
{
    protected string $accountId;

    protected ProviderType $providerType;

    protected Position $position;

    protected bool $withoutCache = false;

    public function toRequestData(): array
    {
        return [
            'withoutCache' => $this->withoutCache(),
            'providerType' => $this->providerType->value,
            'latitude' => $this->position->getLatitude(),
            'longitude' => $this->position->getLongitude(),
        ];
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getProviderType(): ProviderType
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
