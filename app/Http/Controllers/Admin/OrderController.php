<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $orders = order::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.order.index')->with('title_page', 'Danh sách đơn hàng')
                                        ->with('orders', $orders);
    }

    public function postOrder()
    {

        // dd(request()->remove_id);
        if(request()->id){
            $id = request()->id;
            $order_info = order::findOrFail($id);
            $order_detail = $order_info->order_detail()->get();
            $results = json_encode(array($order_info, $order_detail));
            return response($results);
        }else if(request()->confirm_id){
            $id = request()->confirm_id;
            $order_info = order::findOrFail($id);
            if($order_info->status != 1){
                $order_info->status = 1;
            }
            $order_info->save();
            return response($order_info->status);
        }else if(request()->success_id){
            $id = request()->success_id;
            $order_info = order::findOrFail($id);
            if($order_info->status != 2){
                $order_info->status = 2;
            }
            $order_info->save();
            return response($order_info->status);
        }else if(request()->ship_id){
            $id = request()->ship_id;
            $order_info = order::findOrFail($id);
            if($order_info->status != 3){
                $order_info->status = 3;
            }
            $order_info->save();
            return response($order_info->status);
        } else {
            $id = request()->remove_id;
            $order_info = order::findOrFail($id);
            if($order_info->publish != 0) {
                $order_info->publish = 0;
            }
            $order_info->save();
            return response($order_info->publish);
        }
    }

    public function search()
    {
        $orders = order::orderBy('created_at', 'desc')->where('id', 'like' , request()->keyword . '%')->paginate(12);
        return response($orders); 
    }
}
