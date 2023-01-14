<?php

namespace App\Services;

use App\Repositories\PlayerTokenRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class PlayerTokenService
{
    private const TTL = 2592000;

    public function addPlayer(array $rawData)
    {
        if (empty($rawData)) {
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

    /**
     * TODO: 1. by 登入的使用者決定能 get 的玩家 token
     *       2. 使用者可 get 的玩家流水號應記錄於快取
     */
    public function getPlayerTokens(): JsonResponse
    {
        $data = resolve(PlayerTokenRepository::class)->getAllTokens();
        $array = [];
        foreach ($data as $datum) {
            $array[$datum->player_name] = [
                'player_id' => $datum->player_id,
                'token' => $datum->token,
            ];
        }
        return response()->json($array, 200);
    }
}
