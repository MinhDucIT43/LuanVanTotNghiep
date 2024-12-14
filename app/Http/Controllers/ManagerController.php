<?php

namespace App\Http\Controllers;

use App\Models\positions;

use App\Http\Requests\PositionRequest;

use Carbon\Carbon;

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

    public function addPosition(PositionRequest $request)
    {
        $position = new positions();
        $position->position_name = $request->positionName;
        $position->salary = $request->salary;
        $position->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $position->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $position->save();
        return redirect()->back()->with('success', 'Thêm chức vụ thành công!');
    }

    public function updatePosition(PositionRequest $request, $position)
    {
        positions::where('position_code',$position)->update([
            'position_name' => $request->positionName,
            'salary' => $request->salary,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]); 
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function deletePosition($position)
    {
        $checkChildOfPosition = positions::find($position);
        if($checkChildOfPosition->staffs()->exists()){
            return redirect()->back()->with('error','Tồn tại nhân viên có chức vụ bạn muốn xoá!');
        }else{
            positions::where('position_code',$position)->delete();
            return redirect()->back()->with('success','Xóa chức vụ thành công!');
        }
    }
}
