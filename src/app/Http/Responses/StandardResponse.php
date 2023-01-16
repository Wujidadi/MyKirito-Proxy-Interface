<?php

namespace App\Http\Responses;

use App\Constants\ErrDef;

/**
 * 自訂標準回應類別
 *
 * @property ErrorInfoBag $error
 * @property array $data
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
