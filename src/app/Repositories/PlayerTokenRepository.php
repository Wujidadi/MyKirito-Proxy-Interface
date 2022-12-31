<?php

namespace App\Repositories;

use App\Models\PlayerTokens;

class PlayerTokenRepository
{
    public function addPlayer(array $rawData): int
    {
        return resolve(PlayerTokens::class)->insertOrIgnore($rawData);
    }

    public function getIdByName(string $name): ?string
    {
        $player = resolve(PlayerTokens::class)
            ->select(['player_id'])
            ->where('player_name', $name)
            ->first();
        return $player ? $player->player_id : null;
    }

    public function getTokenByName(string $name): ?string
    {
        $player = resolve(PlayerTokens::class)
            ->select(['player_id', 'section_2', 'section_3'])
            ->where('player_name', $name)
            ->first();
        return $player ? $player->token : null;
    }
}
