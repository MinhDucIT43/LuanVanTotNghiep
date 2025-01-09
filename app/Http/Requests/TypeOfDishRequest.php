<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TypeOfDishRequest extends FormRequest
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
        $id = $this->route('id');

        $rules = [
            'nameTypeDish' => ['required'],
        ];

        if($id){
            $rules['nameTypeDish'][] = Rule::unique('typeofdish','nameTypeDish')->ignore($id,'id');
        }else{
            $rules['nameTypeDish'][] = Rule::unique('typeofdish','nameTypeDish');
        }
        
        return $rules;
    }

    public function messages(): array
    {
        return [
            'nameTypeDish.required' => "Vui lòng nhập tên loại món ăn.",
            'nameTypeDish.unique' => "Loại món ăn này đã tồn tại.",
        ];
    }
}
