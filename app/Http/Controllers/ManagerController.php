<?php

namespace App\Http\Controllers;

use App\Models\positions;

use App\Http\Requests\AddPositionRequest;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        return view('manager.index');
    }

    public function getPosition()
    {
        $getPositions = positions::orderBy('position_code', 'desc')->get();
        return view('position.index', compact('getPositions'));
    }

    public function addPosition(AddPositionRequest $request)
    {
        $position = new positions();
        $position->position_name = $request->positionName;
        $position->salary = $request->salary;
        $position->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $position->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $position->save();
        return redirect()->back()->with('success', 'Thêm chức vụ thành công!');
    }

    public function updatePosition(Request $request, $position)
    {
        positions::where('position_code',$position)->update([
            'position_name' => $request->positionName,
            'salary' => $request->salary,
        ]); 
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function deletePosition($position)
    {
        positions::where('position_code',$position)->delete();
        return redirect()->back()->with('success','Xóa chức vụ thành công!');
    }
}
