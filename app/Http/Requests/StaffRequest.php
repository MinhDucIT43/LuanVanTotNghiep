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
            'imgOfStaff' => 'image|mimes:jpg,png|max:5120',
            'birthday' => 'required|date|before:today|before_or_equal:' . now()->subYears(18)->format('m-d-Y'),
            'address' => 'required',
            'workingDay' => 'required|date',
            'phone' => 'required|numeric|regex:/^(0|\+84)[3|5|7|8|9][0-9]{10,15}$/|unique:staffs,phone',
            'position' => 'required',
            'password' => 'required'
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'fullName.required' => "Vui lòng nhập tên nhân viên.",
            'imgOfStaff.image' => "Vui lòng chọn file ảnh.",
            'imgOfStaff.mimes' => "Chỉ chấp nhận tệp có định dạng .jpg hoặc .png",
            'imgOfStaff.max' => "Kích thước tệp không được vượt quá 5MB.",
            'birthday.required' => "Vui lòng chọn ngày, tháng, năm sinh.",
            'birthday.date' => "Vui lòng nhập ngày theo định dạng hợp lệ: d/m/Y hoặc m/d/Y hoặc Y/m/d",
            'birthday.before' => "Vui lòng nhập ngày tháng năm trước hôm nay.",
            'birthday.before_or_equal' => "Chưa đủ 18 tuổi.",
            'address.required' => "Vui lòng nhập địa chỉ.",
            'workingDay.required' => "Vui lòng chọn ngày, tháng, năm vào làm việc.",
            'workingDay.date' => "Vui lòng nhập ngày theo định dạng hợp lệ: d/m/Y hoặc m/d/Y hoặc Y/m/d",
            'phone.required' => "Vui lòng nhập số điện thoại.",
            'phone.numeric' => "Số điện thoại chỉ được nhập số.",
            'phone.regex' => "Vui lòng nhập đúng định dạng số Việt Nam (+84|0...) có độ dài từ 10 đến 15 số.",
            'phone.unique' => "Đã có nhân viên có số điện thoại này.",
            'password.required' => "Vui lòng nhập mật khẩu.",
        ];
    }
}
