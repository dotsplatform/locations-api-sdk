<?php
/**
 * Description of DistanceResultsDTOs.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\App\Client\DTO\Results;

use Dots\Data\DTO;

class DistanceResultsDTOs extends DTO
{
    /** @var array<string, DistanceResultDTO> */
    protected array $items;

    public static function fromArray(array $data): static
    {
        $items = [];
        foreach ($data as $type => $item) {
            $items[$type] = DistanceResultDTO::fromArray($item);
        }

        return parent::fromArray([
            'items' => $items,
        ]);
    }

    public function toArray(): array
    {
        $data = [];
        foreach ($this->items as $type => $item) {
            $data[$type] = $item->toArray();
        }

        return $data;
    }

    public function getItemByTransportType(string $transportType): ?DistanceResultDTO
    {
        return $this->items[$transportType] ?? null;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
