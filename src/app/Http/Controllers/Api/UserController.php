<?php

namespace App\Http\Controllers\Api;

use App\Constants\ErrDef;
use App\Constants\JsonFlag;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddRequest as AddUserRequest;
use App\Http\Responses\StandardResponse;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function add(AddUserRequest $request)
    {
        $validated = $request->validated();

        $response = new StandardResponse();
        $httpCode = 200;

        $user = new Users();
        $user->name = $validated['username'];
        $user->password = Hash::make($validated['password']);

        if (!$user->save()) {
            $response->error->code = ErrDef::DB_INSERT_ERROR;
            $response->error->message = ErrDef::MESSAGE[ErrDef::DB_INSERT_ERROR];
            $response->data = ['使用者註冊失敗'];
            $httpCode = 500;
        }

        return response()->json($response, $httpCode, [], JsonFlag::UNESCAPED);
    }
}
