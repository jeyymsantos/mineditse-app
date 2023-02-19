<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{

    public function admin_index()
    {
        $customers = DB::table('customers')
            ->select('*')
            ->join('users', 'users.id', '=', 'customers.cust_id')
            ->orderBy('first_name')
            ->where('cust_type', '<>', 'DEACTIVATED')
            ->get();

        return view('admin.customers.view', [
            'customers' => $customers,
            'i' => 1
        ]);
    }

    public function admin_archive()
    {

        $customers = DB::table('customers')
            ->select('*')
            ->join('users', 'users.id', '=', 'customers.cust_id')
            ->orderBy('first_name')
            ->where('cust_type', '=', 'DEACTIVATED')
            ->get();

        return view('admin.customers.archive', [
            'customers' => $customers,
            'i' => 1
        ]);
    }

    public function admin_reactivate($id)
    {

        $customer = Customer::find($id);
        $customer->cust_type = "NEW";
        $customer->save();

        return redirect()->route('archive')
            ->with('successfull', 'Customer has been successfully reactivated!');
    }

    public function admin_view_customer($id)
    {
        $user = DB::table('customers')
            ->select('*')
            ->join('users', 'customers.cust_id', '=', 'users.id')
            ->where('customers.cust_id', '=', $id)
            ->get()->first();

        $orders = DB::table('orders')
            ->select('*')
            ->join('customers', 'customers.cust_id', '=', 'orders.cust_id')
            ->join('users', 'customers.cust_id', '=', 'users.id')
            ->orderBy('order_date', 'desc')
            ->where('orders.cust_id', '=', $id)->get();

        return view('admin.customers.view_specific', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }

    public function admin_edit_customer($id)
    {
        $user = DB::table('customers')
            ->select('*')
            ->join('users', 'customers.cust_id', '=', 'users.id')
            ->where('customers.cust_id', '=', $id)
            ->get()->first();

        return view('admin.customers.edit', [
            'user' => $user,
        ]);
    }

    public function admin_save_customer(Request $req, $id)
    {
        $user = User::find($id);
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->phone_number = $req->phone_number;
        $user->save();

        $customer = Customer::find($id);
        $customer->cust_street = $req->street;
        $customer->cust_barangay = $req->barangay;
        $customer->cust_city = $req->city;
        $customer->cust_province = $req->province;
        $customer->save();

        return redirect()->route('admin_customers')
            ->with('successfull', 'Customer edited successfully!');
    }

    public function admin_deactivate($id)
    {
        $customer = Customer::find($id);
        $customer->cust_type = "DEACTIVATED";
        $customer->save();

        return redirect()->route('admin_customers')
            ->with('successfull', 'Customer has been successfully deactivated!');
    }

    public function index(Request $req)
    {
        $customer = Customer::find(Auth::user()->id);
        if ($customer->cust_type == "DEACTIVATED") {
            Session::flush();
            Auth::logout();

            return redirect()->route('main')->with([
                "error_title" => "Account is deactivated",
                "error_msg" => "Sorry, your account is deactivated. Please contact Mine Ditse to reactivate your account. Thank you."
            ]);
        }

        $search = $req->search;

        $products = DB::table('products')
            ->select('*', 'categories.category_id')
            ->join('bales', 'products.bale_id', '=', 'bales.bale_id')
            ->join('categories', 'bales.category_id', '=', 'categories.category_id')
            ->orderBy('prod_id')
            ->where('prod_status', '<>', 'Sold', 'and')
            ->where(function ($query) use ($search) {
                $query->where('prod_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('category_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('prod_qr_code', 'LIKE', '%' . $search . '%');
            })
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

    public function ViewProfile()
    {
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

    public function ConfirmOrder($id)
    {

        $order = Order::find($id);

        if ($order->payment_status == "Pending") {
            return redirect()->route('view_profile')->with([
                'error_msg' => 'Sorry, cannot complete order since payment is still pending. Settle your account with Mine Ditse to process your transaction.',
                'error_title' => 'Payment Not Settled'
            ]);
        }

        $order->order_status = "Completed";
        $order->completed_date = Carbon::now();
        $order->save();

        return redirect()->route('view_profile')
            ->with('successfull', 'Order completed successfully!');
    }

    public function DeactivateCustomer()
    {
        $customer = Customer::find(Auth::user()->id);
        $customer->cust_type = "DEACTIVATED";
        $customer->save();

        Session::flush();
        Auth::logout();

        return redirect()->route('main');
    }

    public function EditProfile(Request $req)
    {

        $user = User::find(Auth::user()->id);
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->phone_number = $req->phone_number;
        $user->save();

        $customer = Customer::find(Auth::user()->id);
        $customer->cust_street = $req->street;
        $customer->cust_barangay = $req->barangay;
        $customer->cust_city = $req->city;
        $customer->cust_province = $req->province;
        $customer->save();

        return redirect()->route('view_profile')
            ->with('successfull', 'Customer edited successfully!');
    }

    public function Settings()
    {
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

        return view('customers.settings.view', [
            'carts' => $carts,
            'orders' => $orders,
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

    public function CartSubmit(Request $req)
    {

        $order = new Order();
        $order->cust_id = Auth::user()->id;
        $order->staff_id = Auth::user()->id;
        $order->order_total = $req->order_total;
        $order->order_shipping_fee = "0";
        $order->order_method = $req->order_method;
        $order->payment_method = $req->payment_method;
        $order->payment_cash = "0";
        $order->payment_status = "Pending";
        $order->order_status = "For " . $req->order_method;
        $order->order_details = $req->remarks;
        $order->save();

        // return response()->json($order, 200, [], JSON_PRETTY_PRINT);

        $carts = DB::table('carts')
            ->select('*')
            ->join('products', 'products.prod_id', '=', 'carts.prod_id')
            ->where('user_id', '=', Auth::id())->get();

        foreach ($carts as $cart) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->order_id;
            $order_detail->prod_id = $cart->prod_id;
            $order_detail->save();

            $edit = Product::find($cart->prod_id);
            $edit->prod_status = "Sold";
            $edit->save();
            Cart::find($cart->card_id)->delete();
        }

        return redirect('/customer/orders/checkout')->with(
            'successfull',
            'Your order has been placed! Visit your profile to check invoice.'
        );
    }

    public function ViewTransactions()
    {
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
            ->where('orders.cust_id', '=', Auth::user()->id)->get();

        $user = DB::table('customers')
            ->select('*')
            ->join('users', 'customers.cust_id', '=', 'users.id')
            ->where('customers.cust_id', '=', Auth::user()->id)
            ->get()->first();

        return view('customers.transactions', [
            'carts' => $carts,
            'orders' => $orders,
            'user' => $user
        ]);
    }
}
