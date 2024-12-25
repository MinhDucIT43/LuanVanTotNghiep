<?php

namespace App\Http\Controllers;

use App\Models\positions;
use App\Models\staffs;

use App\Http\Requests\PositionRequest;
use App\Http\Requests\StaffRequest;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function index()
    {
        return view('manager.index');
    }

    // Manager Position
    public function getPosition()
    {
        $getPositions = positions::orderBy('position_code', 'desc')->simplePaginate(7);
        return view('manager.position.index', compact('getPositions'));
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
        positions::where('position_code', $position)->update([
            'position_name' => $request->positionName,
            'salary' => $request->salary,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function deletePosition($position)
    {
        $checkChildOfPosition = positions::find($position);
        if ($checkChildOfPosition->staffs()->exists()) {
            return redirect()->back()->with('error', 'Tồn tại nhân viên có chức vụ bạn muốn xoá!');
        } else {
            positions::where('position_code', $position)->delete();
            return redirect()->back()->with('success', 'Xóa chức vụ thành công!');
        }
    }

    // Manager Staff
    public function getStaff()
    {
        $getStaffs = staffs::orderBy('staff_code', 'desc')->get();
        $positions = positions::all();
        return view('manager.staff.index', compact('getStaffs', 'positions'));
    }

    public function getOptionPosition()
    {
        $positions = positions::all();
        return response()->json($positions);
    }

    public function addStaff(StaffRequest $request)
    {
        $staff = new staffs();
        $staff->fullName = $request->fullName;
        $staff->imgOfStaff = $request->imgOfStaff;
        $staff->birthday = $request->birthday;
        $staff->sex = $request->sex;
        $staff->address = $request->address;
        $staff->workingDay = $request->workingDay;
        $staff->phone = $request->phone;
        $staff->password = Hash::make($request->password);
        $staff->position_code = $request->position;
        $staff->save();
        return redirect()->back()->with('success', 'Thêm nhân viên thành công!');
    }
}
