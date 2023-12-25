<?php
/**
 * Description of AutocompleteResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Results;

use Dots\Data\DTO;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;

class AutocompleteResponseDTO extends DTO
{
    protected bool $active = false;

    protected ?ProviderType $provider;

    protected array $apiKeys = [];

    public static function fromArray(array $data): static
    {
        if (! empty($data['provider'])) {
            $data['provider'] = ProviderType::from($data['provider']);
        }

        return parent::fromArray($data);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['provider'] = $this->getProvider()?->value;

        return $data;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getProvider(): ?ProviderType
    {
        return $this->provider;
    }

    public function getApiKeys(): array
    {
        return $this->apiKeys;
    }
}
