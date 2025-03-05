<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TableRequest extends FormRequest
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
            'nameTable' => ['required'],
            'status' => 'required',
        ];

        if($id){
            $rules['nameTable'][] = Rule::unique('tables','nameTable')->ignore($id,'id');
        }else{
            $rules['nameTable'][] = Rule::unique('tables','nameTable');
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nameTable.required' => "Vui lòng nhập tên bàn.",
            'nameTable.unique' => 'Tên bàn đã tồn tại',
            'status.required' => "Vui lòng chọn trạng thái bàn.",
        ];
    }
}
