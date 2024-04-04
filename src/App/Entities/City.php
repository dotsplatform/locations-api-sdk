<?php
/**
 * Description of City.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Entities;

use Dots\Data\Entity;

class City extends Entity
{
    protected string $id;

    protected string $accountId;

    protected string $name;

    protected ?array $polygonData;

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPolygonData(): ?array
    {
        return $this->polygonData;
    }
}
