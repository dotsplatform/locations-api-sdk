<?php
/**
 * Description of ProviderType.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO;

enum ProviderType: string
{
    case HERE = 'here';
    case GOOGLE = 'google';
    case VISICOM = 'visicom';
    case BY_AIR = 'by_air';
}
