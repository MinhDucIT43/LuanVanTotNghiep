<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
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
            'nameTicket' => ['required'],
            'price' => 'required|numeric|gt:-1',
        ];

        if($id){
            $rules['nameTicket'][] = Rule::unique('tickets','nameTicket')->ignore($id,'id');
        }else{
            $rules['nameTicket'][] = Rule::unique('tickets','nameTicket');
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nameTicket.required' => "Vui lòng nhập tên vé buffet.",
            'nameTicket.unique' => "Vé buffet này đã tồn tại.",
            'price.required' => "Vui lòng nhập giá vé buffet.",
            'price.numeric' => "Giá vé buffet phải là số.",
            'price.gt' => "Giá vé buffet không được nhỏ hơn 0.",
        ];
    }
}
