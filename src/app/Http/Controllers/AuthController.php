<?php

namespace App\Http\Controllers;

use App\Constants\ErrDef;
use App\Traits\JsonResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Utilities\Log\Facade as LogFacade;

class AuthController extends Controller
{
    use JsonResponseBuilder;

    private const TTL_IN_MINUTES = 120;
    private const LONG_TTL_IN_MINUTES = 20160;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login()
    {
        $credentials = request(['name', 'password']);
        $rememberMe = request('rememberMe', true);
        $ttl = $rememberMe ? self::LONG_TTL_IN_MINUTES : self::TTL_IN_MINUTES;

        if (!$token = Auth::setTTL($ttl)->attempt($credentials, $rememberMe)) {
            return $this->singleJsonResponse(ErrDef::LOGIN_NOT_MATCH, '帳號或密碼錯誤', 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return $this->jsonResponse(ErrDef::OK, [
            'jwt' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
            ],
        ]);
    }
}
