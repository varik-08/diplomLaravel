<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::where('status', 1)->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function ordersShow(Order $order)
    {
        return view('admin.orders.show', compact(['order']));
    }
}
