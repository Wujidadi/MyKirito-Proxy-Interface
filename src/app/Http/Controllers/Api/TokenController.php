<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PlayerTokenService;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function getTokens(Request $request)
    {
        return resolve(PlayerTokenService::class)->getPlayerTokens();
    }
}
