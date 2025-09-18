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
    case GRAPH_HOPPER = 'graph_hopper';

    public static function getGeocodeProviderTypes(): array
    {
        return [
            self::HERE,
            self::GOOGLE,
            self::VISICOM,
        ];
    }

    public static function getDistanceProviderTypes(): array
    {
        return [
            self::HERE,
            self::GOOGLE,
            self::VISICOM,
            self::BY_AIR,
            self::GRAPH_HOPPER,
        ];
    }

    public static function getAutocompleteProviderTypes(): array
    {
        return [
            self::HERE,
            self::GOOGLE,
        ];
    }
}
