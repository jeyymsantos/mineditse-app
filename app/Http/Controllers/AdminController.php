<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $find = Admin::where('admin_id', '=', Auth::user()->id)->first();
        if($find == null){
            $admin = new Admin();
            $admin->admin_id = Auth::user()->id;
            $admin->save();
        }

        $customers = Customer::all();
        $suppliers = Supplier::all();
        $bales = Bale::all();
        $products = Product::all();

        $pending = DB::table('orders')->select('*')
        ->where('payment_status', '=', 'Pending')
        ->where('order_status', '<>', 'Cancelled')
        ->get();

        $pickup = DB::table('orders')->select('*')
        ->where('order_method', '=', 'Pick-Up')
        ->where('order_status', '<>', 'Cancelled')
        ->get();

        $delivery = DB::table('orders')->select('*')
        ->where('order_method', '=', 'Delivery')
        ->where('order_status', '<>', 'Cancelled')
        ->get();

        $meetup = DB::table('orders')->select('*')
        ->where('order_method', '=', 'Meet-Up')
        ->where('order_status', '<>', 'Cancelled')
        ->get();


        return view('admin.landing_page', [
            'suppliers' => $suppliers,
            'customers' => $customers,
            'bales' => $bales,
            'products' => $products,
            'pending' => $pending,
            'pickup' => $pickup,
            'delivery' => $delivery,
            'meetup' => $meetup,
        ]);
    }
}
