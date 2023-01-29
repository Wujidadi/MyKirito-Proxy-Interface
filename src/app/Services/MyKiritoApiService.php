<?php

namespace App\Services;

use App\Constants\MyKirito\Api;
use App\Constants\MyKirito\ApiList;
use App\Services\MyKiritoApiClient as ApiClient;
use App\Services\PlayerTokenService;
use App\Utilities\Log\Facade as LogFacade;
use GuzzleHttp\RequestOptions as HttpRequestOptions;
use stdClass;

class MyKiritoApiService
{
    protected string $playerName;
    protected string $playerId;
    protected string $playerToken;
    protected PlayerTokenService $playerTokenService;
    protected array $requestParams;

    public function __construct(string $playerName, array $headers = [])
    {
        $this->playerName = $playerName;
        $this->playerTokenService = resolve(PlayerTokenService::class);
        $this->playerToken = $this->playerTokenService->getPlayerToken($this->playerName);
        $this->playerId = explode('.', $this->playerToken)[0];
        $this->requestParams = [
            'method' => 'GET',
            'uri' => '',
            'headers' => array_merge([
                'referer' => Api::REFERER,
                'token' => $this->playerToken,
                'user-agent' => Api::DEFAULT_USER_AGENT,
            ], $headers),
            'options' => [
                HttpRequestOptions::JSON => [],
            ],
            'isAsyncRequest' => false,
        ];
    }

    public function getPersonalInfo(): stdClass
    {
        $api = ApiList::LIST[ApiList::GET_PERSONAL_INFO];
        $this->requestParams['method'] = $api[0];
        $this->requestParams['uri'] = $api[1];
        $response = resolve(ApiClient::class)->request($this->requestParams);
        return $response;
    }

    public function updatePlayerStatus(string $status): stdClass
    {
        $api = ApiList::LIST[ApiList::UPDATE_PERSONAL_STATUS];
        $this->requestParams['method'] = $api[0];
        $this->requestParams['uri'] = $api[1];
        $this->requestParams['options'][HttpRequestOptions::JSON] = [
            'status' => $status,
        ];
        $response = resolve(ApiClient::class)->request($this->requestParams);
        return $response;
    }

    public function setTeammate(string $teammate): stdClass
    {
        $api = ApiList::LIST[ApiList::SET_TEAMMATE];
        $this->requestParams['method'] = $api[0];
        $this->requestParams['uri'] = $api[1];
        $this->requestParams['options'][HttpRequestOptions::JSON] = [
            'teammate' => $teammate,
        ];
        $response = resolve(ApiClient::class)->request($this->requestParams);
        return $response;
    }

    public function doAction(string $action): stdClass
    {
        $api = ApiList::LIST[ApiList::DO_ACTION];
        $this->requestParams['method'] = $api[0];
        $this->requestParams['uri'] = sprintf($api[1], $this->playerId);
        $this->requestParams['options'][HttpRequestOptions::JSON] = [
            'action' => $action,
        ];
        $response = resolve(ApiClient::class)->request($this->requestParams);
        return $response;
    }

    public function getAchievements(): stdClass
    {
        $api = ApiList::LIST[ApiList::GET_ACHIEVEMENTS];
        $this->requestParams['method'] = $api[0];
        $this->requestParams['uri'] = $api[1];
        $response = resolve(ApiClient::class)->request($this->requestParams);
        return $response;
    }
}
