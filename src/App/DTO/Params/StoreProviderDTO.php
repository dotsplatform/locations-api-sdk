<?php
/**
 * Description of StoreProviderDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params;

use Dots\Data\DTO;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;

class StoreProviderDTO extends DTO
{
    protected string $accountId;

    protected ProviderType $providerType;

    protected array $data;

    public static function fromArray(array $data): static
    {
        $data['providerType'] = ProviderType::from($data['providerType']);

        return parent::fromArray($data);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['providerType'] = $this->getProviderType()->value;

        return $data;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getProviderType(): ProviderType
    {
        return $this->providerType;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
