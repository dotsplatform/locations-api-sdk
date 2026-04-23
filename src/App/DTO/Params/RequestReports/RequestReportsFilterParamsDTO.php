<?php

/**
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params\RequestReports;

use Dots\Data\DTO;

class RequestReportsFilterParamsDTO extends DTO
{
    protected ?string $accountId = null;

    protected ?string $provider = null;

    protected ?string $providerKey = null;

    protected ?string $method = null;

    protected string $periodType;

    /** @var string[] */
    protected array $periods;

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function getProviderKey(): ?string
    {
        return $this->providerKey;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function getPeriodType(): string
    {
        return $this->periodType;
    }

    public function getPeriods(): array
    {
        return $this->periods;
    }

    public function toRequestData(): array
    {
        $data = [
            'period_type' => $this->periodType,
            'periods' => $this->periods,
        ];

        if ($this->accountId !== null) {
            $data['account_id'] = $this->accountId;
        }

        if ($this->provider !== null) {
            $data['provider'] = $this->provider;
        }

        if ($this->providerKey !== null) {
            $data['provider_key'] = $this->providerKey;
        }

        if ($this->method !== null) {
            $data['method'] = $this->method;
        }

        return $data;
    }
}
