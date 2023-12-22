<?php
/**
 * Description of Provider.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Entities;

use Dots\Data\Entity;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;

class Provider extends Entity
{
    protected string $id;

    protected ProviderType $type;

    protected string $accountId;

    protected array $data;

    public static function fromArray(array $data): static
    {
        $data['type'] = ProviderType::from($data['type']);

        return parent::fromArray($data);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['type'] = $this->getType()->value;

        return $data;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): ProviderType
    {
        return $this->type;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
