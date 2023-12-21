<?php
/**
 * Description of ProviderType.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\Client\DTO;

enum ProviderType: string
{
    case HERE = 'here';
    case GOOGLE = 'google';
}
