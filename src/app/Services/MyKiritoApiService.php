<?php

namespace App\Services;

use App\Services\PlayerTokenService;

class MyKiritoApiService
{
    protected ?string $playerName;

    protected ?string $playerToken;
    protected ?PlayerTokenService $playerTokenService;

    public function __construct(string $playerName)
    {
        $this->playerName = $playerName;
        $this->playerTokenService = resolve(PlayerTokenService::class);
        $this->playerToken = $this->playerTokenService->getPlayerToken($playerName);
    }
}
