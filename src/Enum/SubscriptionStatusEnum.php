<?php

namespace App\Enum;

enum SubscriptionStatusEnum: string
{
    case STARTED = "started";
    case RENEWED = "renewed";
    case CANCELED = "canceled";

    public static function values(): array
    {
        return [
            self::STARTED,
            self::RENEWED,
            self::CANCELED,
        ];
    }
}
