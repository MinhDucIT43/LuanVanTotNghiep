<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $position_code = $this->route('position_code');
        
        $rules = [
            'positionName' => ['required'],
            'salary' => 'required|numeric|gt:-1',
        ];

        if($position_code){
            $rules['positionName'][] = Rule::unique('positions','position_name')->ignore($position_code,'position_code');
        }else{
            $rules['positionName'][] = Rule::unique('positions','position_name');
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'positionName.required' => "Vui lòng nhập tên chức vụ.",
            'positionName.unique' => "Chức vụ này đã tồn tại.",
            'salary.required' => "Vui lòng nhập lương căn bản.",
            'salary.numeric' => "Lương căn bản phải là số.",
            'salary.gt' => "Lương căn bản không được nhỏ hơn 0.",
        ];
    }
}
