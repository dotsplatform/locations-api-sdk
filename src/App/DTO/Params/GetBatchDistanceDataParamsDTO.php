<?php
/**
 * Description of GetBatchDistanceDataParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params;

use Dots\Data\DTO;

class GetBatchDistanceDataParamsDTO extends DTO
{
    protected string $accountId;

    protected GetBatchDistanceDataParamsList $items;

    public function toRequestData(): array
    {
        $data = [];
        foreach ($this->getItems() as $key => $item) {
            $data[$key] = $item->toRequestData();
        }

        return [
            'data' => $data,
        ];
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getItems(): GetBatchDistanceDataParamsList
    {
        return $this->items;
    }
}
