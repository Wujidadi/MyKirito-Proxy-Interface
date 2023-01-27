<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PlayerTokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TokenController extends Controller
{
    public function getTokens(Request $request): JsonResponse
    {
        return response()->json(resolve(PlayerTokenService::class)->getPlayerTokens(), Response::HTTP_OK);
    }
}
