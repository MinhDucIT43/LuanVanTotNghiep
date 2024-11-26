<?php

namespace App\Http\Controllers;

use App\Models\positions;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index(){
        return view('manager.index');
    }

    public function getPosition(){
        $getPositions = positions::all();
        return view('position.index', compact('getPositions'));
    }
}
