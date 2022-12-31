<?php

namespace App\Utilities\Log;

use App\Constants\JsonFlag;
use Illuminate\Support\Facades\Log;

/**
 * @method void info(string $message, mixed ...$context)
 * @method void debug(string $message, mixed ...$context)
 * @method void notice(string $message, mixed ...$context)
 * @method void alert(string $message, mixed ...$context)
 * @method void warning(string $message, mixed ...$context)
 * @method void error(string $message, mixed ...$context)
 * @method void emergency(string $message, mixed ...$context)
 * @method void critical(string $message, mixed ...$context)
 */
class Logger
{
    private string $channel;

    public function __construct(string $channel)
    {
        $this->channel = $channel;
    }

    public function __call(string $name, array|\Countable $arguments)
    {
        $count = count($arguments);
        if ($count > 1) {
            for ($i = 1; $i < $count; $i++) {
                if (is_object($arguments[$i]) || is_array($arguments[$i])) {
                    $arguments[$i] = json_encode($arguments[$i], JsonFlag::UNESCAPED);
                }
            }
        }
        $message = call_user_func_array('sprintf', $arguments);
        if ($this->channel == 'laravel') {
            Log::$name($message);
        } else {
            Log::channel($this->channel)->$name($message);
        }
    }
}
