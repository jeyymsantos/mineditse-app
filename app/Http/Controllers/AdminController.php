<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bale;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Staff;
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

        $total_sales = Order::where('payment_status', "=", "Received", 'and')->where('order_status', "<>", "Cancelled")->sum('order_total');
        $pending_payments = Order::where('payment_status', "<>", "Received", 'and')->where('order_status', "<>", "Cancelled")->sum('order_total');
        $products_sold = Product::where('prod_status', '=', 'Sold')->get();
        $orders = Order::where('order_status', '=', 'Completed');

        return view('admin.landing_page', [
            'products_sold' => $products_sold,
            'orders' => $orders,
            'total_sales' => $total_sales,
            'pending_payments' => $pending_payments,
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

    public function ViewStaffs(){

        $staffs = DB::table('staff')
        ->select('*')
        ->join('users', 'users.id', '=', 'staff.staff_id')
        ->where('staff_status', '=', 'ACTIVE')
        ->get();

        return view('admin.staffs.view')
        ->with([
            'staffs' => $staffs,
            'i' => 1
        ]);
    }

    public function EditStaff($id){
        $staff = DB::table('staff')
        ->select('*')
        ->join('users', 'users.id', '=', 'staff.staff_id')
        ->where('staff_id', '=', $id)
        ->get()->first();

        return view('admin.staffs.edit')
        ->with([
            'user' => $staff,
        ]);
    }

    public function SaveEdit(Request $req, $id){

        $user = User::find($id);
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->phone_number = $req->phone_number;
        $user->save();

        $staff = Staff::find($id);
        $staff->staff_hired_date = $req->date;
        $staff->save();

        return redirect()->route('ViewStaffs')
        ->with([
            'successfull' => 'Staff edited successfully!',
        ]);
    }

    public function AddStaff(){
        return view('admin.staffs.add');
    }

    public function SaveStaff(Request $req){

        $user = new User();
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->phone_number = $req->phone_number;
        $user->role = "staff";
        $user->email = $req->email;
        $user->password =  Hash::make($req->password);
        $user->save();

        $staff = new Staff();
        $staff->staff_id = $user->id;
        $staff->staff_hired_date = $req->date;
        $staff->save();

        return redirect()->route('ViewStaffs')
        ->with([
            'successfull' => 'Staff saved successfully!',
        ]);
    }

    public function DeactivateStaff($id)
    {
        $staff = Staff::find($id);
        $staff->staff_status = "DEACTIVATED";
        $staff->save();

        return redirect()->route('ViewStaffs')
        ->with('successfull', 'Staff is now deactivated!');
    }
    
    public function ArchiveStaffs(){

        $staffs = DB::table('staff')
        ->select('*')
        ->join('users', 'users.id', '=', 'staff.staff_id')
        ->where('staff_status', '=', 'DEACTIVATED')
        ->get();

        return view('admin.staffs.archive')
        ->with([
            'staffs' => $staffs,
            'i' => 1
        ]);
    }

    public function RestoreStaff($id)
    {

        $staff = Staff::find($id);
        $staff->staff_status = "ACTIVE";
        $staff->save();

        return redirect()->route('ArchiveStaffs')
            ->with('successfull', 'Staff has been successfully reactivated!');
    }
}
