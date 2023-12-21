<?php
/**
 * Description of GetBatchDistanceDataParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\App\Client\DTO\Params;

use Dots\Data\DTO;

class GetBatchDistanceDataParamsDTO extends DTO
{
    protected string $accountId;

    protected array $items;

    public function toRequestData(): array
    {
        $data = array_map(
            fn (GetDistanceDataParamsDTO $item) => $item->toRequestData(),
            $this->getItems(),
        );

        return [
            'data' => $data,
        ];
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @return  GetDistanceDataParamsDTO[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
