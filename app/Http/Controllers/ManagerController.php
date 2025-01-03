<?php

namespace App\Http\Controllers;

use App\Models\positions;
use App\Models\staffs;

use App\Http\Requests\PositionRequest;
use App\Http\Requests\StaffRequest;

use Carbon\Carbon;
use Google\Cloud\Storage\Connection\Rest;
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
        $getStaffs = staffs::orderBy('staff_code', 'desc')->simplePaginate(3);
        return view('manager.staff.index', compact('getStaffs'));
    }

    public function addStaff(StaffRequest $request)
    {
        $staff = new staffs();
        $staff->fullName = $request->fullName;
        $staff->imgOfStaff = ($request->imgOfStaff)->getClientOriginalName();
        $staff->birthday = $request->birthday;
        $staff->sex = $request->sex;
        $staff->address = $request->address;
        $staff->workingDay = $request->workingDay;
        $staff->phone = $request->phone;
        $staff->position_code = $request->position;
        $staff->password = Hash::make($request->password);
        $staff->save();
        return redirect()->back()->with('success', 'Thêm nhân viên thành công!');
    }
    
    public function updateStaff(StaffRequest $request, $staff)
    {
        // staffs::where('staff_code', $staff)->update([
        //     'fullName' => $request->fullName,
        //     'imgOfStaff' => $request->imgOfStaff,
        //     'birthday' => $request->birthday,
        //     'sex' => $request->sex,
        //     'address' => $request->address,
        //     'workingDay' => $request->workingDay,
        //     'phone' => $request->phone,
        //     'position_code' => $request->position,
        //     'password' => Hash::make($request->password),
        //     'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        // ]);
        $staff = staffs::findOrFail($staff);
        $staff->fullName = $request->fullName;
        if(!empty($request->imgOfStaff)){
            $staff->imgOfStaff = ($request->imgOfStaff)->getClientOriginalName();
        }
        $staff->birthday = $request->birthday;
        $staff->sex = $request->sex;
        $staff->address = $request->address;
        $staff->workingDay = $request->workingDay;
        $staff->phone = $request->phone;
        $staff->position_code = $request->position;
        if(!empty($request->password)){
            $staff->password = Hash::make($request->password);
        }
        $staff->status = $request->status;
        $staff->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $staff->save();
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function deleteStaff($staff)
    {
        staffs::where('staff_code', $staff)->delete();
        return redirect()->back()->with('success', 'Xóa nhân viên thành công!');
    }
}
