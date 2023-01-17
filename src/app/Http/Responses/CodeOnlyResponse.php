<?php

namespace App\Http\Responses;

use App\Constants\ErrDef;

/**
 * 只須指定錯誤代碼及陣列資料的回應類別
 */
class CodeOnlyResponse extends StandardResponse
{
    public function __construct(
        string $code = ErrDef::OK,
        array $data = []
    ) {
        $this->error = new ErrorInfoBag($code,  ErrDef::MESSAGE[$code]);
        $this->data = $data;
    }
}
