<?php

namespace App\Services;

use App\Repositories\PlayerTokenRepository;
use Illuminate\Support\Facades\Cache;

class PlayerTokenService
{
    private const TTL = 2592000;

    public function addPlayer(array $rawData)
    {
        if (count($rawData) === 0) {
            return 0;
        }

        if (isset($rawData[0]) && is_array($rawData[0]) && count($rawData[0]) === 0) {
            return 0;
        }

        $data = [];

        if (!is_array($rawData[0])) {
            $tokenSections = explode('.', $rawData[1]);
            $data = [
                'player_name' => $rawData[0],
                'player_id' => $tokenSections[0],
                'section_2' => $tokenSections[1],
                'section_3' => $tokenSections[2],
            ];
        } else {
            foreach ($rawData as $rawDatum) {
                $tokenSections = explode('.', $rawDatum[1]);
                $data[] = [
                    'player_name' => $rawDatum[0],
                    'player_id' => $tokenSections[0],
                    'section_2' => $tokenSections[1],
                    'section_3' => $tokenSections[2],
                ];
            }
        }

        return resolve(PlayerTokenRepository::class)->addPlayer($data);
    }

    public function getPlayerToken(string $name): ?string
    {
        $cacheKey = 'player_token_' . $name;
        if ($token = Cache::get($cacheKey)) {
            return $token;
        }
        if ($token = resolve(PlayerTokenRepository::class)->getTokenByName($name)) {
            Cache::put($cacheKey, $token, self::TTL);
            return $token;
        }
        return null;
    }
}
