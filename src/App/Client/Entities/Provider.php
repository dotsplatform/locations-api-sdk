<?php
/**
 * Description of Provider.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\App\Client\Entities;

use Dots\Data\Entity;
use Dotsplatform\LocationsApiSdk\App\Client\DTO\ProviderType;

class Provider extends Entity
{
    protected string $id;

    protected ProviderType $type;

    protected string $accountId;

    protected array $data;

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
