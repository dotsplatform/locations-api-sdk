<?php

/**
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params\RequestReports;

use Dots\Data\DTO;

class RequestReportsSummaryParamsDTO extends DTO
{
    protected ?string $accountId = null;

    protected string $periodType;

    /** @var string[] */
    protected array $periods;

    protected string $groupBy;

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function getPeriodType(): string
    {
        return $this->periodType;
    }

    public function getPeriods(): array
    {
        return $this->periods;
    }

    public function getGroupBy(): string
    {
        return $this->groupBy;
    }

    public function toRequestData(): array
    {
        $data = [
            'period_type' => $this->periodType,
            'periods' => $this->periods,
            'group_by' => $this->groupBy,
        ];

        if ($this->accountId !== null) {
            $data['account_id'] = $this->accountId;
        }

        return $data;
    }
}
