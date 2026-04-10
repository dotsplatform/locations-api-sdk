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

    protected string $dateFrom;

    protected string $dateTo;

    protected string $groupBy;

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function getPeriodType(): string
    {
        return $this->periodType;
    }

    public function getDateFrom(): string
    {
        return $this->dateFrom;
    }

    public function getDateTo(): string
    {
        return $this->dateTo;
    }

    public function getGroupBy(): string
    {
        return $this->groupBy;
    }

    public function toRequestData(): array
    {
        $data = [
            'period_type' => $this->periodType,
            'date_from' => $this->dateFrom,
            'date_to' => $this->dateTo,
            'group_by' => $this->groupBy,
        ];

        if ($this->accountId !== null) {
            $data['account_id'] = $this->accountId;
        }

        return $data;
    }
}
