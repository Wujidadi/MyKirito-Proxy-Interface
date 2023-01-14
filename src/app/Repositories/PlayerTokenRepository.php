<?php

namespace App\Repositories;

use App\Models\PlayerTokens;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

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

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAllTokens(): DatabaseCollection
    {
        return resolve(PlayerTokens::class)
            ->select(['player_name', 'player_id', 'section_2', 'section_3'])
            ->get();
    }
}
