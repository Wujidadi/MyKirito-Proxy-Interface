<?php

namespace App\Utilities\Common;

use App\Constants\JsonFlag;

class Unicode
{
    public static function unescape(string $string): string
    {
        if ($jsonObj = json_decode($string)) {
            return json_encode($jsonObj, JsonFlag::UNESCAPED);
        }
        $jsonObj = json_decode('["' . $string . '"]');
        return trim(json_encode($jsonObj, JsonFlag::UNESCAPED), '[]"');
    }
}
