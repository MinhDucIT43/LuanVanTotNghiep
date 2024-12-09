<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPositionRequest;
use App\Models\positions;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(){
        return view('manager.index');
    }

    public function getPosition(){
        $getPositions = positions::all();
        return view('position.index', compact('getPositions'));
    }

    public function getAddPosition(AddPositionRequest $request){
        dd($request->positionName);
    }
}
