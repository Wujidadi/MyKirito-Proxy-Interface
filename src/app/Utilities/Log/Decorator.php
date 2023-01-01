<?php

namespace App\Utilities\Log;

use App\Utilities\Common\Unicode;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Header as HttpHeader;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;

class Decorator
{
    private array $arr;

    private ?ResponseInterface $response;

    public function decorate(array $arr, ?ResponseInterface $response): array
    {
        $this->arr = $arr;
        $this->response = $response;

        $this->decorateTime();
        $this->decorateReqBody();
        if ($this->response) {
            $this->decorateResBody($arr, $response);
        }

        return $this->arr;
    }

    private function decorateTime(): void
    {
        $this->arr['time'] = Carbon::parse($this->arr['time'])
            ->timezone(config('app.timezone'))
            ->toDateTimeString();
    }

    private function decorateReqBody(): void
    {
        $this->arr['req_body'] = Unicode::unescape(mb_convert_encoding($this->arr['req_body'], 'UTF-8'));
    }

    private function decorateResBody(): void
    {
        if (! array_key_exists('res_body', $this->arr)) {
            return;
        }
        $type = $this->response->getHeader('content-type');
        $parsed = HttpHeader::parse($type);
        $from_encoding = Arr::get($parsed, '0.charset') ?: 'UTF-8';
        $this->arr['res_body'] = Unicode::unescape(mb_convert_encoding($this->arr['res_body'], 'UTF-8', $from_encoding));
    }
}