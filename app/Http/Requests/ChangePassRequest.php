<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'passWordOld' => 'required',
            'passWordNew' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'passWordOld.required' => "Vui lòng nhập mật khẩu cũ.",
            'passWordNew.required' => "Vui lòng nhập mật khẩu mới.",
        ];
    }
}
