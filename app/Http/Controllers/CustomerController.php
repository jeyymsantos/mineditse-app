<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('customers.landing_page');
    }
}
