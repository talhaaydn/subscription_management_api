<?php

namespace App\Enum;

enum OperatingSystemEnum: string
{
    case IOS = "ios";
    case GOOGLE = "google";

    public static function values(): array
    {
        return [
            self::IOS,
            self::GOOGLE,
        ];
    }
}
