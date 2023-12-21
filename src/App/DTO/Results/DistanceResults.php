<?php
/**
 * Description of DistanceResultsDTOs.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Results;

use Dots\Data\FromArrayable;
use Illuminate\Support\Collection;

/** @extends Collection<string, DistanceResultDTO> */
class DistanceResults extends Collection implements FromArrayable
{
    public static function fromArray(array $data): static
    {
        $items = [];
        foreach ($data as $type => $item) {
            $items[$type] = DistanceResultDTO::fromArray($item);
        }

        return new static($items);
    }

    public function getItemByTransportType(string $transportType): ?DistanceResultDTO
    {
        return $this->get($transportType);
    }
}
