<?php

namespace App\Http\Controllers;

use App\Http\Requests\postUpdateOrder;
use App\Order;
use App\Category;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact(['products']));
    }

    public function categories()
    {
        $categories = Category::all();
        return view('categories', compact(['categories']));
    }

    public function basketAdd(Product $product)
    {
        if (session()->has('orderNumber')) {
            $orderNumber = session()->get('orderNumber');
            $order = Order::find($orderNumber);
            $countProduct = $order->products()->where('product_id', $product->id)->value('count');
            if ($countProduct == null) {
                $order->products()->attach($product);
            } else {
                $order->products()->updateExistingPivot($product, ['count' => ++$countProduct]);
            }
        } else {
            $order = Order::create();
            $order->products()->attach($product);
            session(['orderNumber' => $order->id]);
        }
        session()->flash('success', 'Добавлен товар ' . $product->name);
        return redirect(route('basket.show'));
    }

    public function basketShow()
    {
        $order = Order::find(session()->get('orderNumber'));
        return view('basket', compact(['order']));
    }

    public function basketPlace()
    {
        $order = Order::find(session()->get('orderNumber'));
        return view('order', compact(['order']));
    }

    public function basketRemove(Product $product)
    {
        $orderNumber = session()->get('orderNumber');
        $order = Order::find($orderNumber);
        $countProduct = $order->products()->where('product_id', $product->id)->value('count');
        if ($countProduct == 1) {
            $order->products()->detach($product);
            if($order->products()->count() == 0)
            {
                session()->forget('orderNumber');
            }
        } else {
            $order->products()->updateExistingPivot($product, ['count' => --$countProduct]);
        }

        session()->flash('warning', 'Удален товар ' . $product->name);
        return redirect(route('basket.show'));
    }

    public function basketAccept(postUpdateOrder $request)
    {
        $order = Order::find(session()->get('orderNumber'));
        $order->update([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'status' => '1',
        ]);
        session()->forget('orderNumber');
        session()->flash('success', 'Ваш заказ принят в обработку!');
        return redirect()->route('index');
    }

    public function reset()
    {
        Order::truncate();
        DB::table('order_product')->truncate();
        session()->forget('orderNumber');
        return redirect()->route('index');
    }
}
