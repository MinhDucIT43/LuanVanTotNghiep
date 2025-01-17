<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DishRequest extends FormRequest
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
            'nameDish' => ['required'],
            'price' => 'required|numeric|gt:-1',
            'typeOfDish' => 'required',
        ];

        if($id){
            $rules['nameDish'][] = Rule::unique('dish','nameDish')->ignore($id,'id');
        }else{
            $rules['nameDish'][] = Rule::unique('dish','nameDish');
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nameDish.required' => "Vui lòng nhập tên món ăn.",
            'nameDish.unique' => "Món ăn này đã tồn tại.",
            'price.required' => "Vui lòng nhập giá món ăn.",
            'price.numeric' => "Giá món ăn phải là số.",
            'price.gt' => "Giá món ăn không được nhỏ hơn 0.",
            'typeOfDish.required' => "Vui lòng chọn loại của món.",
        ];
    }
}
