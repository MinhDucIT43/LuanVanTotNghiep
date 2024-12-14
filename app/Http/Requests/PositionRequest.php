<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            'positionName' => 'required|unique:positions,position_name',
            'salary' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'positionName.required' => "Vui lòng nhập tên chức vụ.",
            'positionName.unique' => "Chức vụ này đã tồn tại.",
            'salary.required' => "Vui lòng nhập lương căn bản.",
        ];
    }
}
