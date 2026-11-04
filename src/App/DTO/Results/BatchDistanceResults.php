<?php
/**
 * Description of BatchDistanceResultDTOs.php.
 *
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Results;

use Illuminate\Support\Collection;

/** @extends Collection<string, DistanceResults> */
class BatchDistanceResults extends Collection
{
    /**
     * Locations answers null for an item it could not resolve (a provider error for that route).
     * Such items are left out, so getItemByKey() returns null for them and the caller can
     * retry only the missing keys instead of dropping the whole batch.
     */
    public static function fromArray(array $data): static
    {
        $items = [];
        foreach ($data as $key => $item) {
            if (! is_array($item)) {
                continue;
            }
            $items[$key] = DistanceResults::fromArray($item);
        }

        return new static($items);
    }

    public function getItemByKey(string $key): ?DistanceResults
    {
        return $this->get($key);
    }

    public function hasItemByKey(string $key): bool
    {
        return $this->has($key);
    }

    /**
     * @param  string[]  $requestedKeys
     * @return string[]
     */
    public function getMissingKeys(array $requestedKeys): array
    {
        $missingKeys = [];
        foreach ($requestedKeys as $requestedKey) {
            if (! $this->hasItemByKey($requestedKey)) {
                $missingKeys[] = $requestedKey;
            }
        }

        return $missingKeys;
    }
}
