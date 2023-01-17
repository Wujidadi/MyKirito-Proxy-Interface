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

    public const LOGIN_NOT_MATCH = '10';
    public const JWT_EXCEPTION = '11';

    public const DB_INSERT_ERROR = '41';
    public const DB_UPDATE_ERROR = '42';
    public const DB_DELETE_ERROR = '44';

    public const MESSAGE = [
        self::OK => 'OK',

        self::GENERAL_ERROR => 'General error',
        self::INPUT_ERROR => 'Input error',

        self::LOGIN_NOT_MATCH => 'Login not match',
        self::JWT_EXCEPTION => 'JWT exception',

        self::DB_INSERT_ERROR => 'DB insert error',
        self::DB_UPDATE_ERROR => 'DB update error',
        self::DB_DELETE_ERROR => 'DB delete error',
    ];
}
