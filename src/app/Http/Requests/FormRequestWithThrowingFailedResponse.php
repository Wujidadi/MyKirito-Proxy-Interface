<?php

namespace App\Http\Requests;

use App\Constants\ErrDef;
use App\Constants\JsonFlag;
use App\Http\Responses\StandardResponse;
use App\Utilities\Log\Facade as LogFacade;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * 表單請求驗證器，遇錯誤時直接返回 JSON response
 */
class FormRequestWithThrowingFailedResponse extends FormRequest
{
    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $response = new StandardResponse(
            ErrDef::INPUT_ERROR,
            ErrDef::MESSAGE[ErrDef::INPUT_ERROR],
            $validator->errors()->toArray()
        );
        LogFacade::mykirito()->error('%s', $response);
        throw new HttpResponseException(response()->json($response, 422, [], JsonFlag::UNESCAPED));
    }
}
