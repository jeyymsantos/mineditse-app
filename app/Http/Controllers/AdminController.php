<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.landing_page', [
            'suppliers' => $suppliers,
            'customers' => $customers,
            'bales' => $bales,
            'products' => $products,
        ]);
    }
}
