<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
        $rules = [
            'fullName' => 'required',
            'imgOfStaff' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048',],
            'birthday' => 'required|before:-18 years',
            'address' => 'required',
            'workingDay' => 'required',
            'phone' => 'required|numeric|unique:staffs,phone',
            'position' => 'required',
            'password' => 'required'
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'fullName.required' => "Vui lòng nhập tên nhân viên.",
            'imgOfStaff.required' => "Vui lòng chọn ảnh nhân viên.",
            'imgOfStaff.image' => "Vui lòng chọn file ảnh.",
            'imgOfStaff.mimes' => "Chỉ chấp nhận tệp có định dạng .jpg hoặc .png",
            'imgOfStaff.max' => "Kích thước tệp không được vượt quá 5MB.",
            'birthday.required' => "Vui lòng chọn ngày, tháng, năm sinh.",
            'birthday.before' => "Người này chưa đủ 18 tuổi.",
            'address.required' => "Vui lòng nhập địa chỉ.",
            'workingDay.required' => "Vui lòng chọn ngày, tháng, năm vào làm việc.",
            'phone.required' => "Vui lòng nhập số điện thoại.",
            'phone.numeric' => "Số điện thoại chỉ được nhập số.",
            'phone.unique' => "Đã có nhân viên có số điện thoại này.",
            'position.required' => "Vui lòng chọn chức vụ.",
            'password.required' => "Vui lòng nhập mật khẩu.",
        ];
    }
}
