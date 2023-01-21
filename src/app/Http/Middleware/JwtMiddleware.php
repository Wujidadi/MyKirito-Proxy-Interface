<?php

namespace App\Http\Middleware;

use App\Constants\ErrDef;
use App\Traits\JsonResponseBuilder;
use App\Utilities\Log\Facade as LogFacade;
use Closure;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    use JsonResponseBuilder;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return $this->singleJsonResponse(ErrDef::LOGIN_NOT_MATCH, '帳號或密碼錯誤', Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            return $this->singleJsonResponse(ErrDef::JWT_EXCEPTION, $e->getMessage(), Response::HTTP_UNAUTHORIZED);
        } catch (Exception $e) {
            return $this->singleJsonResponse(ErrDef::GENERAL_ERROR, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $next($request);
    }
}
