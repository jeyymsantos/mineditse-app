<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function ViewProfile(){
        $user = User::find(Auth::user()->id);
        return view('admin.profile', [
            'user' => $user
        ]);
    }

    public function UpdatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with([
                "error_title" => "Old Password Doesn't match!",
                "error_msg" => "Kindly input your correct old password in order to proceed."
            ]);
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("successfull", "Password changed successfully!");
    }
}
