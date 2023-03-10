<?php

namespace Widget;

/**
 * 自訂命令行輔助工具
 */
class CliHelper
{
    /**
     * 格式化命令行輸出
     *
     * @param string $text 輸出字串
     * @param string $hexColor `#RRGGBB` 格式色碼
     * @param bool $breakLine 最後是否換行，預設 `false`
     * @param bool $underline 字元是否帶底線，預設 `false`
     * @return string ANSI 格式化輸出字元
     */
    public static function colorText(string $text, string $hexColor = '', bool $breakLine = false, bool $underline = false): string
    {
        $eot = $breakLine ? PHP_EOL : '';
        $udl = $underline ? ';4' : '';

        if ($hexColor === '' || is_null($hexColor)) {
            return "{$text}{$eot}";
        } else {
            list($r, $g, $b) = sscanf($hexColor, '#%02x%02x%02x');
            return "\033[38;2;{$r};{$g};{$b}{$udl}m{$text}\033[0m{$eot}";
        }
    }
}
