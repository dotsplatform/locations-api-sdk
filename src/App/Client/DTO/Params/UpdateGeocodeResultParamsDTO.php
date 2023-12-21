<?php
/**
 * Description of UpdateGeocodeResultParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\App\Client\DTO\Params;

use Dots\Data\DTO;

class UpdateGeocodeResultParamsDTO extends DTO
{
    protected string $accountId;

    protected string $address;

    protected float $latitude;

    protected float $longitude;

    public function toRequestData(): array
    {
        return [
            'address' => $this->getAddress(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
        ];
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }
}
