<?php
/**
 * Description of TransportType.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\App\Client\DTO;


enum TransportType: string
{
    case CAR = 'car';
    case BICYCLE = 'bicycle';
    case PEDESTRIAN = 'pedestrian';
}