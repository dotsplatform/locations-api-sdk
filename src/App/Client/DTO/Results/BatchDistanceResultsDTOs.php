<?php
/**
 * Description of BatchDistanceResultDTOs.php.
 *
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace Dotsplatform\LocationsApiSdk\App\Client\DTO\Results;

use Dots\Data\DTO;

class BatchDistanceResultsDTOs extends DTO
{
    /** @var array<string, DistanceResultsDTOs|null> */
    protected array $items;

    public static function fromArray(array $data): static
    {
        $items = [];
        foreach ($data['items'] as $key => $item) {
            $items[$key] = DistanceResultsDTOs::fromArray($item);
        }

        return parent::fromArray([
            'items' => $items,
        ]);
    }

    public function toArray(): array
    {
        $data = [];
        foreach ($this->items as $key => $item) {
            $data[$key] = ! is_null($item) ? $item->toArray() : null;
        }

        return $data;
    }

    public function getItemByKey(string $key): ?DistanceResultsDTOs
    {
        if (! isset($this->items[$key])) {
            return null;
        }

        return $this->items[$key];
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
