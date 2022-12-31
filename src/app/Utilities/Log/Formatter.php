<?php

namespace App\Utilities\Log;

use App\Constants\JsonFlag;
use App\Utilities\Log\Decorator as LogDecorator;
use GuzzleHttp\MessageFormatter as HttpMessageFormatter;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Formatter extends HttpMessageFormatter
{
    private const DELIMITER = '-0-0-0-0-0-0-0-0-0-';

    public function __construct()
    {
        $arr = [
            'method' => '{method}',
            'uri' => '{uri}',
            'time' => '{ts}',
            'status' => '{code}',
            'req_body' => '{req_body}',
            'res_body' => '{res_body}',
            'error' => '{error}',
        ];
        $template = collect($arr)
            ->map(function ($value, $key) {
                return "{$key},{$value}";
            })
            ->implode(self::DELIMITER);
        parent::__construct($template);
    }

    public function format(
        RequestInterface $request,
        ?ResponseInterface $response = null,
        ?\Throwable $error = null
    ): string {
        $format = parent::format($request, $response, $error);
        $request->getBody()->rewind();
        if (!$error) {
            $response->getBody()->rewind();
        }
        $value = explode(self::DELIMITER, $format);
        $arr = collect($value)
            ->mapWithKeys(function ($value) {
                $pair = $this->buildMessage($value);
                return [$pair->key => $pair->value];
            })
            ->all();
        return json_encode(
            resolve(LogDecorator::class)->decorate($arr, $response),
            JsonFlag::UNESCAPED
        );
    }

    protected function buildMessage(string $str): \stdClass
    {
        $arr = explode(',', $str);
        $key = array_shift($arr);
        $value = implode(',', $arr);
        return (object) compact('key', 'value');
    }
}
