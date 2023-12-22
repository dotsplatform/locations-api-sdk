<?php
/**
 * Description of UpdateGeocodeResultParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO\Params;

use Dots\Data\DTO;
use Dots\Distance\Position;

class UpdateGeocodeResultParamsDTO extends DTO
{
    protected string $accountId;

    protected string $address;

    protected Position $position;

    public static function fromArray(array $data): static
    {
        $data['position'] = Position::fromArray($data['position'] ?? []);

        return parent::fromArray($data);
    }

    public function toRequestData(): array
    {
        return [
            'address' => $this->getAddress(),
            'latitude' => $this->getPosition()->getLatitude(),
            'longitude' => $this->getPosition()->getLongitude(),
        ];
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }
}
