<?php

namespace App\Utilities\Client;

use App\Utilities\Log\Formatter as LogFormatter;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack as HttpHandlerStack;
use GuzzleHttp\Middleware as HttpMiddleware;
use Illuminate\Support\Facades\Log;

class ClientFactory
{
    public static function create(string $channel, array $config = []): HttpClient
    {
        $stack = HttpHandlerStack::create();
        (!config("logging.channels.{$channel}.by_middleware", true)) || $stack->push(
            HttpMiddleware::log(
                Log::channel($channel),
                new LogFormatter()
            ),
            'log'
        );
        return resolve(HttpClient::class, [
            'config' => array_merge([
                'cookies' => true,
                'handler' => $stack,
            ], $config),
        ]);
    }
}
