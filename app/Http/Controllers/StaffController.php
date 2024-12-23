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
}
