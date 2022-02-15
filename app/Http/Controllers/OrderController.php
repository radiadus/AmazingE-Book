<?php

namespace App\Http\Controllers;

use App\Models\EBook;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showCart(){
        $cart = EBook::with(['orders' => function($query){
            $query->where('account_id', Auth::user()->account_id);
        }])->get();

        return view('cart', compact('cart'));
    }

    public function rent(Request $request){
        $time_now = date("Y-m-d");

        $order = Order::latest()->first();

        if($order)
        {
            $new_order = $order->order_id + 1;
        }
        else
        {
            $new_order = 1;
        }

        $rent = Order::create([
            'order_id'=>$new_order,
            'account_id'=> Auth()->user()->account_id,
            'ebook_id'=>$request->ebook_id,
            'order_date'=>$time_now
        ]);

        return redirect('cart');
    }

    public function delete($id){
        Order::where('order_id', $id)->delete();

        return redirect('cart');
    }

    public function submit(){
        $id = Auth::user()->account_id;
        Order::where('account_id', $id)->delete();

        return redirect('success');

    }
}
