<?php

namespace App\Http\Controllers;

use App\Models\tables;

class StaffController extends Controller
{
    public function index(){
        $getTables = tables::all();
        return view('staff.index', compact('getTables'));
    }

    public function order($id){
        dd("Đây là bàn: " . $id);
    }
}
