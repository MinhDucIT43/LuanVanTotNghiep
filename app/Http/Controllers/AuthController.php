<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function getLogin()
    {
        if (!Auth::guard('staffs')->check()) {
            return view('login');
        } else {
            return redirect()->back()->with('error', 'Vui lòng đăng xuất!');
        }
    }

    public function postLogin(AuthRequest $request)
    {
        $staff = [
            'phone' => $request->input('phone'),
            'password' => $request->input('password'),
        ];
        if (Auth::guard('staffs')->attempt($staff)) {
            if (Gate::forUser(Auth::guard('staffs')->user())->allows('isAdmin')) {
                return redirect()->route('manager.index')->with('success', 'Đăng nhập thành công!');
            } else {
                return redirect()->route('staff.index')->with('success', 'Đăng nhập thành công!');
            }
        } else {
            return redirect()->back()->with('error', 'Thông tin đăng nhập không chính xác!');
        }
    }

    public function logout()
    {
        Auth::guard('staffs')->logout();
        return redirect()->route('auth.getLogin')->with('success', 'Đăng xuất thành công!');
    }
}
