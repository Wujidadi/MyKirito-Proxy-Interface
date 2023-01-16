<?php

namespace App\Http\Responses;

use App\Constants\ErrDef;

/**
 * 錯誤訊息物件
 *
 * @property string $code
 * @property string $message
 */
class ErrorInfoBag
{
    public string $code;
    public string $message;

    public function __construct(
        string $code = ErrDef::OK,
        string $message = ErrDef::MESSAGE[ErrDef::OK]
    ) {
        $this->code = $code;
        $this->message = $message;
    }
}
