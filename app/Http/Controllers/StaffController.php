<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\staffs;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index(){
        return view('staff.index');
    }

    public function addstaff(Request $request){
        if($request->session()->has('loginId')){
            $staff = new staffs();
            $staff->fullname = $request->fullname;
            $staff->birthday = $request->birthday;
            $staff->sex = $request->sex;
            $staff->address = $request->address;
            $staff->workingday = $request->workingday;
            $staff->phone = $request->phone;
            $staff->password = Hash::make($request->password);
            $staff->save();
            return redirect()->back()->with('success','Thêm nhân viên thành công!');
        }else{
            return redirect()->route('index.login')->with('error','Vui lòng đăng nhập!');
        }
    }
}
