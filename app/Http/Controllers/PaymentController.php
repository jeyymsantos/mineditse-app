<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function ViewPayment($id)
    {

        $orders = DB::table('orders')
            ->select('*')
            ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
            ->leftJoin('customers', 'users.id', '=', 'customers.cust_id')
            ->leftJoin('order_detail', 'order_detail.order_id', '=', 'orders.order_id')
            ->leftJoin('products', 'order_detail.prod_id', '=', 'products.prod_id')
            ->leftJoin('bales', 'bales.bale_id', '=', 'products.bale_id')
            ->leftJoin('categories', 'categories.category_id', 'bales.category_id')
            ->where('orders.order_id', '=', $id)
            ->get();

        $order = $orders->first();
        if ($order->payment_status == "Received") {
            return redirect()
                ->route('orders')
                ->with([
                    'error_title' => 'Payment already received.',
                    'error_msg' => 'Sorry! You cannot pay twice for an order.',
                    'orders' => $orders,
                    'i' => 1,
                ]);
        }

        $staff = DB::table('orders')
            ->select('*')
            ->join('users', 'orders.staff_id', '=', 'users.id')
            ->where('order_id', '=', $id)
            ->get()->first();

        if ($order == null) {
            $orders = DB::table('orders')
                ->select('*', 'users.name')
                ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
                ->get();
            return redirect()
                ->route('orders')
                ->with([
                    'error_title' => 'Order does not exist',
                    'error_msg' => 'Sorry! There are no such order placed on the system.',
                    'orders' => $orders,
                    'i' => 1,
                ]);
        }

        $carts = DB::table('order_detail')
            ->select('*')
            ->where('order_id', '=', $id)
            ->join('products', 'products.prod_id', '=', 'order_detail.prod_id')
            ->get();

        return view('orders.payment', [
            'orders' => $orders,
            'order' => $order,
            'carts' => $carts,
            'staff' => $staff,
            'i' => 1,
            // 'prod_total' => $products->count(),
        ]);
    }

    public function PayOrder(Request $req){
        $order = Order::find($req->id);
        $total = $order->order_total + $order->order_shipping_fee;

        if($req->order_payment < $total){
            return redirect()
            ->back()
            ->with([
                'error_title' => 'Payment is less than Order Total',
                'error_msg' => 'Sorry! Not enough money. Please make sure to pay exact amount or more.',
                'i' => 1,
            ]);
        }

       $order->payment_cash = $req->order_payment;
       $order->payment_status = "Received";
       $order->save();

       return redirect()
            ->route('orders')
            ->with('successfull', 'Payment has been confirmed & received!');

    }
}
