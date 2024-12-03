<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeRequest;
use App\Http\Requests\RepassRequest;
use App\Http\Requests\ChangePassRequest;

use App\Models\staffs;
use App\Models\codephones;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;

class RepassController extends Controller
{
    public function getResetPassword()
    {
        return view('resetpassword.index');
    }

    public function postResetPassword(RepassRequest $request)
    {
        $checkPhone = staffs::where('phone', $request->phone)->exists();
        $request->session()->put('changePassPhone', $request->phone);
        if ($checkPhone) {
        // $code = random_int(000000, 999999);
        // DB::table('codephones')->insert([
        //     'code' => $code,
        //     'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(10),
        //     'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        // ]);
        // $getStaffCode = staffs::where('phone',$request->phone)->first();
        // $codephone_code  = codephones::where('code',$code)->first();
        // DB::table('staffs_codephones')->insert([
        //     'staff_code' => $getStaffCode->staff_code,
        //     'codephone_code' => $codephone_code->codephone_code,
        // ]);
            return redirect()->route('repass.getCode');
        } else {
            return redirect()->back()->with('error', 'Số điện thoại không đúng.');
        }
    }

    public function getCode()
    {
        return view('resetpassword.inputcode');
    }

    public function postCode(CodeRequest $request)
    {
        dd("ok");
    }

    public function getChangePass()
    {
        return view('resetpassword.changepass');
    }

    public function postChangePass(ChangePassRequest $request)
    {
        $getPhone = $request->session()->get('changePassPhone');
        $getPass = staffs::where('phone', $getPhone)->get('password');
        $checkPhone = staffs::where('phone', $getPhone)->first();
        foreach ($getPass as $getPass) {
        }
        if (Hash::check($request->passWordOld, $getPass->password)) {
            $checkPhone->update([
                'password' => Hash::make($request->passWordNew),
            ]);
            $request->session()->forget('changePassPhone');
            return redirect()->route('auth.getLogin')->with('success', 'Đổi mật khẩu thành công!');
        } else {
            return redirect()->back()->with('error', 'Sai mật khẩu cũ.');
        }
    }
}
