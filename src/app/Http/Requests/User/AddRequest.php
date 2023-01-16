<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequestWithThrowingFailedResponse;

class AddRequest extends FormRequestWithThrowingFailedResponse
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|min:10',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '必須指定使用者帳號',
            'username.min' => '使用者帳號不可少於 10 位',
            'password.required' => '必須指定密碼',
            'password.min' => '密碼不可少於 6 位',
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => '使用者帳號',
            'password' => '密碼',
        ];
    }
}
