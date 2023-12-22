<?php
/**
 * Description of GetBatchDistanceDataParamsList.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params;

use Illuminate\Support\Collection;

/**
 * @extends Collection<string, GetBatchDistanceDataParamsDTO>
 */
class GetBatchDistanceDataParamsList extends Collection
{
    public static function fromArray(array $data): static
    {
        return new static(array_map(
            fn (array $item) => GetDistanceDataParamsDTO::fromArray($item),
            $data,
        ));
    }
}
