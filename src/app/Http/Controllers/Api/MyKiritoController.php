<?php

namespace App\Http\Controllers\Api;

use App\Constants\ErrDef;
use App\Constants\MyKirito\Api;
use App\Http\Controllers\Controller;
use App\Services\MyKiritoApiService;
use App\Traits\JsonResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use stdClass;

class MyKiritoController extends Controller
{
    use JsonResponseBuilder;

    private MyKiritoApiService $service;

    public function __construct(Request $request)
    {
        $this->service = resolve(MyKiritoApiService::class, [
            'playerName' => $request->input('player'),
            'headers' => [
                'user-agent' => $request->header('user-agent', Api::DEFAULT_USER_AGENT),
            ],
        ]);
    }

    private function ajaxResponse(stdClass $response): JsonResponse
    {
        return $this->jsonResponse(
            ErrDef::PROXY_API_OK,
            [$response->body],
            $response->statusCode,
            $response->headers
        );
    }

    public function getPlayerInfo(Request $request)
    {
        return $this->ajaxResponse($this->service->getPersonalInfo());
    }

    public function updatePlayerStatus(Request $request)
    {
        return $this->ajaxResponse($this->service->updatePlayerStatus($request->input('status') ?? ''));
    }

    public function setTeammate(Request $request)
    {
        return $this->ajaxResponse($this->service->setTeammate($request->input('teammate') ?? ''));
    }

    public function doAction(Request $request)
    {
        return $this->ajaxResponse($this->service->doAction($request->input('action')));
    }

    public function getAchievements(Request $request)
    {
        return $this->ajaxResponse($this->service->getAchievements());
    }
}
