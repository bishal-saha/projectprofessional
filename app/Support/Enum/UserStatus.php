<?php

namespace App\Support\Enum;

class UserStatus
{
    const UNCONFIRMED = 'Unconfirmed';
    const ACTIVE = 'Active';
    const BANNED = 'Banned';

    public static function lists()
    {
        return [
            self::UNCONFIRMED => 'Unconfirmed',
            self::ACTIVE => 'Active',
            self::BANNED => 'Banned',
        ];
    }
}