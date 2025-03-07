<?php

namespace App\Http\Controllers;

use App\Http\Requests\SelectTicketPriceRequest;
use App\Models\tables;
use App\Models\tickets;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(){
        $getTables = tables::all();
        return view('staff.index', compact('getTables'));
    }

    public function selectTable($id){
        $table = tables::find($id);
        switch($table->status){
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

    public function selectTicketPrice($id, SelectTicketPriceRequest $request){
        $table = tables::find($id);
        $SelectedTicketPrice = tickets::where('id',$request->ticketPrice)->get();
        $quantity = $request->quantity;
        return view('staff.orderdetails.orderdetails', compact('table','SelectedTicketPrice','quantity'));
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
