<?php

/**
 * Description of LocationSource.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\LocationsApiSdk\DTO;

enum LocationSource: string
{
    case GOOGLE = 'google';
    case HERE = 'here';
    case VISICOM = 'visicom';
    case MANUAL = 'manual';
}
