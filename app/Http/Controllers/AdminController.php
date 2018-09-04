<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
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
