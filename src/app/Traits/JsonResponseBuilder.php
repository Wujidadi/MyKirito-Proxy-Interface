<?php

namespace App\Traits;

use App\Constants\JsonFlag;
use App\Http\Responses\CodeOnlyResponse;
use Illuminate\Http\JsonResponse;

/**
 * 建構統一 JSON 回應可複用程式碼
 */
trait JsonResponseBuilder
{
    /**
     * JSON 回應，`data` 為滿足 `StandardResponse::data` 的鍵值對
     */
    private function jsonResponse(
        string $code = '1',
        array $data = [],
        int $httpStatusCode = 200,
        array $httpHeaders = []): JsonResponse
    {
        return response()->json(new CodeOnlyResponse(
            $code,
            $data,
        ), $httpStatusCode, $httpHeaders, JsonFlag::UNESCAPED);
    }

    /**
     * JSON 回應，`data` 為字串，將自動被轉為滿足 `StandardResponse::data` 的鍵值對  
     * 此 `single` 指 `data` 為單一字串
     */
    private function singleJsonResponse (
        string $code = '1',
        string $data = '',
        int $httpStatusCode = 200,
        array $httpHeaders = []): JsonResponse
    {
        return response()->json(new CodeOnlyResponse(
            $code,
            ['error' => [$data]]
        ), $httpStatusCode, $httpHeaders, JsonFlag::UNESCAPED);
    }
}
