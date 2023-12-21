<?php
/**
 * Description of ReverseGeocodeResultDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Results;

use Dots\Data\DTO;
use Dotsplatform\LocationsApiSdk\DTO\ProviderType;

class ReverseGeocodeResultDTO extends DTO
{
    protected ?ProviderType $provider;

    protected ?string $address;

    protected ?string $country;

    protected ?string $city;

    protected ?string $city_id;

    protected ?string $street;

    protected ?string $number;

    public function getProvider(): ?ProviderType
    {
        return $this->provider;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getCityId(): ?string
    {
        return $this->city_id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function isValid(): bool
    {
        return (bool) $this->getAddress();
    }
}
