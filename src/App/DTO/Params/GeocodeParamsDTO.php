<?php
/**
 * Description of GeocodeParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params;

use Dots\Data\DTO;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;

class GeocodeParamsDTO extends DTO
{
    protected string $accountId;

    protected string $address;

    protected ?ProviderType $providerType;

    protected bool $withoutCache = false;

    public static function fromArray(array $data): static
    {
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
            'address' => $this->getAddress(),
            'provider' => $this->getProviderType()?->value,
        ];
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getProviderType(): ?ProviderType
    {
        return $this->providerType;
    }

    public function withoutCache(): bool
    {
        return $this->withoutCache;
    }
}
