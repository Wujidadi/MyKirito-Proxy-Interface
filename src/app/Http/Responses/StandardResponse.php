<?php

namespace App\Http\Responses;

use App\Constants\ErrDef;

/**
 * 自訂標準回應類別
 *
 * @property ErrorInfoBag $error
 * @property array $data 鍵值對，key 為錯誤類型，value 為該類型所屬錯誤訊息（字串陣列）  
 *                       例如：`['error' => ['帳號錯誤', '密碼未填']]`  
 *                       此資料型態是為了和 FormRequest 的錯誤格式（`Illuminate\Support\MessageBag`）相容
 */
class StandardResponse
{
    public ErrorInfoBag $error;
    public array $data;

    public function __construct(
        string $code = ErrDef::OK,
        string $message = ErrDef::MESSAGE[ErrDef::OK],
        array $data = []
    ) {
        $this->error = new ErrorInfoBag($code,  $message);
        $this->data = $data;
    }
}
