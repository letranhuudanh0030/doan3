<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = order::all();
        return view('backend.dashboard')->with('orders', $orders);
    }

    public function checkOrder()
    {
        $orders = null;
        if(request('status') < 4){
            $orders = order::orderBy('created_at', 'desc')->where('publish', 1)->where('status', request('status'))->paginate(12);
        } else {
            $orders = order::orderBy('created_at', 'desc')->Where('publish', request('publish'))->paginate(12);
        }

        return view('backend.order.index')->with('orders', $orders)
                                        ->with('title_page', 'Danh sách đơn hàng');
    }
}
