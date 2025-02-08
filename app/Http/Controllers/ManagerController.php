<?php

namespace App\Http\Controllers;

use App\Models\positions;
use App\Models\staffs;
use App\Models\typeofdish;
use App\Models\dish;
use App\Models\tickets;

use App\Http\Requests\PositionRequest;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\TypeOfDishRequest;
use App\Http\Requests\DishRequest;
use App\Http\Requests\TicketRequest;
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
        $staff = staffs::findOrFail($staff);
        $staff->fullName = $request->fullName;
        if (!empty($request->imgOfStaff)) {
            $staff->imgOfStaff = ($request->imgOfStaff)->getClientOriginalName();
        } else {
            $staff->imgOfStaff = $staff->imgOfStaff;
        }
        $staff->birthday = $request->birthday;
        $staff->sex = $request->sex;
        $staff->address = $request->address;
        $staff->workingDay = $request->workingDay;
        $staff->phone = $request->phone;
        $staff->position_code = $request->position;
        if (!empty($request->password)) {
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

    // Manager Type Of Dish
    public function getTypeOfDish()
    {
        $getTypeOfDish = typeofdish::orderBy('id', 'desc')->simplePaginate(10);
        return view('manager.typeofdish.index', compact('getTypeOfDish'));
    }

    public function addTypeOfDish(TypeOfDishRequest $request)
    {
        $typeofdish = new typeofdish();
        $typeofdish->nameTypeDish = $request->nameTypeDish;
        $typeofdish->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $typeofdish->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $typeofdish->save();
        return redirect()->back()->with('success', 'Thêm loại món ăn thành công!');
    }

    public function updateTypeOfDish(TypeOfDishRequest $request, $id)
    {
        typeofdish::where('id', $id)->update([
            'nameTypeDish' => $request->nameTypeDish,
            'status' => $request->status,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function deleteTypeOfDish($id)
    {
        $checkChildTypeOfDish = typeofdish::find($id);
        if ($checkChildTypeOfDish->dish()->exists()) {
            return redirect()->back()->with('error', 'Tồn tại món ăn thuộc loại món ăn bạn muốn xoá!');
        } else {
            typeofdish::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Xóa loại món ăn thành công!');
        }
    }

    // Manager Dish
    public function getDish()
    {
        $getDish = dish::orderBy('id', 'desc')->simplePaginate(10);
        return view('manager.dish.index', compact('getDish'));
    }

    public function addDish(DishRequest $request)
    {
        $dish = new dish();
        $dish->nameDish = $request->nameDish;
        $dish->price = $request->price;
        $dish->typeofdish_id = $request->typeOfDish;
        $dish->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $dish->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $dish->save();
        return redirect()->back()->with('success', 'Thêm món ăn thành công!');
    }

    public function updateDish(DishRequest $request, $id)
    {
        dish::where('id', $id)->update([
            'nameDish' => $request->nameDish,
            'price' => $request->price,
            'typeofdish_id' => $request->typeOfDish,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function deleteDish($id)
    {
        dish::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Xóa món ăn thành công!');
    }

    // Manager Tickets
    public function getTicket()
    {
        $getTickets = tickets::orderBy('id', 'desc')->simplePaginate(10);
        return view('manager.ticket.index', compact('getTickets'));
    }

    public function addTicket(TicketRequest $request)
    {
        $ticket = new tickets();
        $ticket->nameTicket = $request->nameTicket;
        $ticket->price = $request->price;
        $ticket->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ticket->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ticket->save();
        return redirect()->back()->with('success', 'Thêm vé buffet thành công!');
    }

    public function updateTicket(TicketRequest $request, $id)
    {
        tickets::where('id', $id)->update([
            'nameTicket' => $request->nameTicket,
            'price' => $request->price,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function deleteTicket($id)
    {
        tickets::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Xóa vé buffet thành công!');
    }

    // Manager Tables
    public function getTable()
    {
        return view('manager.table.index');
    }
}
