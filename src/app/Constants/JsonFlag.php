<?php

namespace App\Constants;

/**
 * JSON flag 常數
 */
class JsonFlag
{
    /**
     * JSON 不轉義，值 = `320`（`JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE`）
     *
     * @var int
     */
    public const UNESCAPED = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

    /**
     * JSON 不轉義格式化，值 = `448`（`JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT`）
     *
     * @var int
     */
    public const PRETTY = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT;
}
