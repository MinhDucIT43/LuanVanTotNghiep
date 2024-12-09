<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeRequest;
use App\Http\Requests\RepassRequest;
use App\Http\Requests\ChangePassRequest;

use App\Models\staffs;
use App\Models\codephones;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RepassController extends Controller
{
    public function inputPhoneNumberAndReceiveCode()
    {
        return view('resetpassword.inputPhoneNumberAndReceiveCode');
    }

    // public function postResetPassword(RepassRequest $request)
    // {
    //     $checkPhone = staffs::where('phone', $request->phone)->exists();
    //     $request->session()->put('changePassPhone', $request->phone);
    //     if ($checkPhone) {
    //     // $code = random_int(000000, 999999);
    //     // DB::table('codephones')->insert([
    //     //     'code' => $code,
    //     //     'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(10),
    //     //     'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
    //     // ]);
    //     // $getStaffCode = staffs::where('phone',$request->phone)->first();
    //     // $codephone_code  = codephones::where('code',$code)->first();
    //     // DB::table('staffs_codephones')->insert([
    //     //     'staff_code' => $getStaffCode->staff_code,
    //     //     'codephone_code' => $codephone_code->codephone_code,
    //     // ]);
    //         return redirect()->route('repass.getCode');
    //     } else {
    //         return redirect()->back()->with('error', 'Số điện thoại không đúng.');
    //     }
    // }

    // public function getCode()
    // {
    //     return view('resetpassword.inputcode');
    // }

    public function verify(CodeRequest $request)
    {
        $data = $request->all();
        $checkPhone = staffs::where('phone', $data['phone'])->exists();
        if ($checkPhone) {
            DB::table('codephones')->insert([
                'code' => 123456,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'expire' => Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(10),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);

            $checkCode = codephones::where('code', $data['code'])->where('expire','>=',Carbon::now('Asia/Ho_Chi_Minh'))->exists();

            if($checkCode){
                $getStaffCode = staffs::where('phone',$data['phone'])->first();
                $codephone_code  = codephones::where('code',$data['code'])->first();
                DB::table('staffs_codephones')->insert([
                    'staff_code' => $getStaffCode->staff_code,
                    'codephone_code' => $codephone_code->codephone_code,
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
                $request->session()->put('changePassPhone', $request->phone);
                return redirect()->route('repass.getChangePass')->with('success', 'Xác thực thành công!');
            }else {
                return redirect()->back()->with('error', 'Mã xác thực không đúng!');
            }
        } else {
            return redirect()->back()->with('error', 'Số điện thoại không đúng.');
        }
    }

    public function getChangePass()
    {
        return view('resetpassword.changepass');
    }

    public function postChangePass(ChangePassRequest $request)
    {
        $getPhone = $request->session()->get('changePassPhone');
        $getPass = staffs::where('phone', $getPhone)->first();
        if (Hash::check($request->passWordOld, $getPass->password)) {
            staffs::where('phone', $getPhone)->update([
                'password' => Hash::make($request->passWordNew),
            ]);
            $request->session()->forget('changePassPhone');
            return redirect()->route('auth.getLogin')->with('success', 'Đổi mật khẩu thành công!');
        } else {
            return redirect()->back()->with('error', 'Sai mật khẩu cũ.');
        }
    }
}
