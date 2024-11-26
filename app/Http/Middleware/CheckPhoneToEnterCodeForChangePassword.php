<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\staffs;

class CheckPhoneToEnterCodeForChangePassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $getPhone = $request->session()->get('changePassPhone');
        if(staffs::where('phone',$getPhone)->exists()){
            return $next($request);
        }else{
            return redirect()->route('repass.getResetPassword')->with('error','Vui lòng nhập số điện thoại!');
        }
    }
}
