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
        $table = tables::find($id);
        switch($table->status){
            case 'trống':
                $this->handleAvailable($table);
                break;

            case 'có khách':
                $this->handleOccupied($table);
                break;

            case 'chờ thanh toán':
                $this->handleWaitingForPayment($table);
                break;

            case 'đặt trước':
                $this->handleReserved($table);
                break;
            
            case 'bảo trì':
                return redirect()->back()->with('warning','Bàn này đang được bảo trì, vui lòng chọn bàn khác.');
                break;
        }
    }

    private function handleAvailable($table)
    {
        dd('chọn vé trước');
    }

    private function handleOccupied($table)
    {
        dd('khách đang ăn nè, chọn thêm món hả?');
    }

    private function handleWaitingForPayment($table)
    {
        dd('khách đang thanh toán');
    }

    private function handleReserved($table)
    {
        dd('bàn đã được đặt');
    }
}
