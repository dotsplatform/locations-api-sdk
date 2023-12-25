<?php
/**
 * Description of AutocompleteResponseDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\DTO\Result;


use Dotsplatform\LocationsApiSdk\DTO\ProviderType;
use Dotsplatform\LocationsApiSdk\DTO\Results\AutocompleteResponseDTO;
use Tests\TestCase;

class AutocompleteResponseDTOTest extends TestCase
{
    public function testExpectsEmpty(): void
    {
        $dto = AutocompleteResponseDTO::empty();

        $this->assertFalse($dto->isActive());
        $this->assertNull($dto->getProvider());
        $this->assertEmpty($dto->getApiKeys());
    }

    public function testCreateNewObjectFromSelf(): void
    {
        $data = [
            'active' => true,
            'provider' => ProviderType::GOOGLE->value,
            'apiKeys' => [
                $this->uuid(),
                $this->uuid(),
            ],
        ];
        $dto = AutocompleteResponseDTO::fromArray(
            AutocompleteResponseDTO::fromArray($data)->toArray()
        );

        $this->assertTrue($dto->isActive());
        $this->assertEquals(ProviderType::GOOGLE, $dto->getProvider());
        $this->assertEquals($data['apiKeys'], $dto->getApiKeys());
    }
}