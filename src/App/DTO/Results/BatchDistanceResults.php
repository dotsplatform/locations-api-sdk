<?php
/**
 * Description of BatchDistanceResultDTOs.php.
 *
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Results;

use Dots\Data\FromArrayable;
use Illuminate\Support\Collection;

/** @extends Collection<string, DistanceResults> */
class BatchDistanceResults extends Collection implements FromArrayable
{
    public static function fromArray(array $data): static
    {
        $items = [];
        foreach ($data as $key => $item) {
            $items[$key] = DistanceResults::fromArray($item);
        }

        return new static($items);
    }

    public function getItemByKey(string $key): ?DistanceResults
    {
        return $this->get($key);
    }
}
