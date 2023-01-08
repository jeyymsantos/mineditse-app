<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {

        $find = Customer::where('cust_id', '=', Auth::user()->id)->first();
        if($find == null){
            $customer = new Customer();
            $customer->cust_id = Auth::user()->id;
            $customer->save();
        }

        $products = DB::table('products')
        ->select('*', 'categories.category_id')
        ->join('bales', 'products.bale_id', '=', 'bales.bale_id')
        ->join('categories', 'bales.category_id', '=', 'categories.category_id')
        ->orderBy('prod_name')
        ->get();

        return view('customers.landing_page', [
            'products' => $products
        ]);
    }
}
