<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    public function admin_index(){
        
    }
    
    public function index()
    {
        // $find = Customer::where('cust_id', '=', Auth::user()->id)->first();
        // if($find == null){
        //     $customer = new Customer();
        //     $customer->cust_id = Auth::user()->id;
        //     $customer->save();
        // }

        $products = DB::table('products')
        ->select('*', 'categories.category_id')
        ->join('bales', 'products.bale_id', '=', 'bales.bale_id')
        ->join('categories', 'bales.category_id', '=', 'categories.category_id')
        ->orderBy('prod_id')
        ->where('prod_status', '<>', 'Sold')
        ->paginate('18')->withQueryString();

        $carts = DB::table('carts')
        ->select('*')
        ->join('products', 'products.prod_id', '=', 'carts.prod_id')
        ->where('user_id', '=', Auth::id())->get();

        return view('customers.landing_page', [
            'products' => $products,
            'carts' => $carts
        ]);
    }

    public function ViewProfile(){
        $carts = DB::table('carts')
        ->select('*')
        ->join('products', 'products.prod_id', '=', 'carts.prod_id')
        ->where('user_id', '=', Auth::id())->get();

        $orders = DB::table('orders')
        ->select('*')
        ->join('customers', 'customers.cust_id', '=', 'orders.cust_id')
        ->join('users', 'customers.cust_id', '=', 'users.id')
        // ->leftJoin('order_detail', 'order_detail.order_id', '=', 'orders.order_id')
        // ->join('products', 'products.prod_id', '=', 'order_detail.prod_id')
        ->orderBy('order_date', 'desc')
        ->where('orders.cust_id', '=', Auth::user()->id)->take(4)->get();

        $user = DB::table('customers')
        ->select('*')
        ->join('users', 'customers.cust_id', '=', 'users.id')
        ->where('customers.cust_id', '=', Auth::user()->id)
        ->get()->first();

        return view('customers.profile', [
            'carts' => $carts,
            'orders' => $orders,
            'user' => $user
        ]);
    }

    public function ConfirmOrder($id){

        $order = Order::find($id);
        $order->order_status = "Completed";
        $order->completed_date = Carbon::now();
        $order->save();

        return redirect()->route('view_profile')
        ->with('successfull', 'Order completed successfully!');

    }
}
