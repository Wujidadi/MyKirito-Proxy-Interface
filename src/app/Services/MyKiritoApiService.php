<?php

namespace App\Services;

use App\Constants\MyKirito\Api as MyKiritoApi;
use App\Constants\MyKirito\ApiList as MyKiritoApiList;
use App\Services\MyKiritoApiClient;
use App\Services\PlayerTokenService;
use GuzzleHttp\RequestOptions as HttpRequestOptions;
use Illuminate\Support\Arr;

class MyKiritoApiService
{
    protected string $playerName;
    protected string $playerToken;
    protected PlayerTokenService $playerTokenService;
    protected array $requestParams;

    public function __construct(string $playerName)
    {
        $this->playerName = $playerName;
        $this->playerTokenService = resolve(PlayerTokenService::class);
        $this->playerToken = $this->playerTokenService->getPlayerToken($playerName);
        $this->requestParams = [
            'method' => 'GET',
            'uri' => '',
            'headers' => [
                'referer' => MyKiritoApi::REFERER,
                'token' => $this->playerToken,
                'user-agent' => MyKiritoApi::DEFAULT_USER_AGENT,
            ],
            'options' => [
                HttpRequestOptions::JSON => [],
            ],
            'isAsyncRequest' => false,
        ];
    }

    public function getPersonalInfo(): array
    {
        $api = MyKiritoApiList::LIST[MyKiritoApiList::GET_PERSONAL_INFO];
        $this->requestParams['method'] = $api[0];
        $this->requestParams['uri'] = $api[1];
        $response = resolve(MyKiritoApiClient::class)->request($this->requestParams);
        return $response->body && Arr::accessible($response->body) ? $response->body : [];
    }
}
