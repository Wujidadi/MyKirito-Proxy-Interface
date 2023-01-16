<?php

namespace App\Constants;

/**
 * 錯誤定義常數
 */
class ErrDef
{
    public const OK = '0';
    public const GENERAL_ERROR = '1';
    public const INPUT_ERROR = '2';
    public const DB_INSERT_ERROR = '3';

    public const MESSAGE = [
        self::OK => 'OK',
        self::GENERAL_ERROR => 'General Error',
        self::INPUT_ERROR => 'Input Error',
        self::DB_INSERT_ERROR => 'DB Insert Error',
    ];
}
