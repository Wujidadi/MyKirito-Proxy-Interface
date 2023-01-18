<?php

namespace App\Http\Controllers\Api;

use App\Constants\ErrDef;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddRequest as AddUserRequest;
use App\Models\Users;
use App\Traits\JsonResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use JsonResponseBuilder;

    public function add(AddUserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $code = ErrDef::OK;
        $data = '';
        $httpStatusCode = Response::HTTP_OK;

        // ToDo: 不要直接呼叫 Model，要透過 Repository -> Service
        $user = new Users();
        $user->name = $validated['username'];
        $user->password = Hash::make($validated['password']);

        if (!$user->save()) {
            $code = ErrDef::DB_INSERT_ERROR;
            $data = '使用者註冊失敗';
            $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->singleJsonResponse($code, $data, $httpStatusCode);
    }
}
