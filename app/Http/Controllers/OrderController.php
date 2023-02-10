<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->select('*', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
            ->get();

        return view('orders.view', [
            'orders' => $orders,
            'i' => 1,
            // 'prod_total' => $products->count(),
        ]);
    }

    public function ViewOrder($id)
    {
        $orders = DB::table('orders')
            ->select('*')
            ->leftJoin('users', 'users.id', '=', 'orders.cust_id')
            ->leftJoin('order_detail', 'order_detail.order_id', '=', 'orders.order_id')
            ->leftJoin('products', 'order_detail.prod_id', '=', 'products.prod_id')
            ->leftJoin('bales', 'bales.bale_id', '=', 'products.bale_id')
            ->leftJoin('categories', 'categories.category_id', 'bales.category_id')
            ->where('orders.order_id', '=', $id)
            ->get();

        $order = $orders->first();

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

        // return response()->json($orders, 200, [], JSON_PRETTY_PRINT);

        return view('orders.view_specific', [
            'orders' => $orders,
            'order' => $order,
            'i' => 1,
            // 'prod_total' => $products->count(),
        ]);
    }

    public function ShowProducts(Request $req)
    {
        $products = DB::table('products')
            ->select('*', 'products.bale_id', 'categories.category_name', 'suppliers.supplier_name')
            ->leftJoin('bales', 'products.bale_id', '=', 'bales.bale_id')
            ->leftJoin('categories', 'bales.category_id', '=', 'categories.category_id')
            ->leftJoin('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')

            ->orderBy('prod_id')
            ->where('prod_deleted', '=', '0', 'and')
            ->where('prod_status', '=', 'Available')
            ->orderBy('prod_id')
            ->get();

        $carts = DB::table('carts')
            ->join('products', 'products.prod_id', 'carts.prod_id')
            ->where('user_id', '=', Auth::id())->get();

        return view('orders.add', [
            'products' => $products,
            'i' => 1,
            'carts' => $carts
        ]);
    }

    public function AddToCart($id)
    {
        $product = Product::find($id);
        $cart = DB::table('carts')
            ->where('prod_id', '=', $id, 'and')
            ->where('user_id', '=', Auth::id());

        $cart_check = $cart->first();

        try {
            $x = $cart_check->prod_id;
            return redirect()->back()
                ->with([
                    'error_title' => 'Product already exist',
                    'error_msg' => 'Sorry! You cannot add a product that already exist on the cart.'
                ]);
        } catch (Exception $e) {
            $cart = new Cart();

            if ($product->prod_status == 'Available') {
                $cart->user_id = Auth::id();
                $cart->prod_id = $id;
                $cart->save();

                return redirect()->back()
                    ->with('successfull', $product->prod_name . ' has been successfully added to cart!');
            } else {
                return redirect()->back()
                    ->with([
                        'error_title' => 'Product Unavailable',
                        'error_msg' => 'Sorry! You cannot add a product that is not available.'
                    ]);
            }
        }

        return response()->json(['cart' => $cart], 200, [], JSON_PRETTY_PRINT);
    }

    public function CartSubmit(Request $req)
    {
        if ($req->id == "false") {
            return redirect()->back()
                ->with([
                    'error_title' => 'Select a Customer!',
                    'error_msg' => 'Sorry! You cannot generate an invoice without selecting a customer.'
                ]);
        }

        $order = new Order();
        $order->cust_id = $req->id;
        $order->staff_id = Auth::user()->id;
        $order->order_total = $req->order_total;
        $order->order_shipping_fee = $req->shipping_fee;
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
            ->join('products', 'products.prod_id', 'carts.prod_id')
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

       return redirect()->route('orders');
    }

    public function ShowCart(Request $req)
    {
        $products = Product::all();

        $carts = DB::table('carts')
            ->select('*')
            ->join('products', 'products.prod_id', 'carts.prod_id')
            ->where('user_id', '=', Auth::id())->get();

        $customers = DB::table('users')
            ->join('customers', 'users.id', '=', 'customers.cust_id')
            ->get();

        return view('orders.cart')->with([
            'carts' => $carts,
            'products' => $products,
            'i' => 1,
            'carts' => $carts,
            'customers' => $customers
        ]);
    }

    public function RemoveFromCart($id)
    {

        $cart = DB::table('carts')
            ->join('products', 'products.prod_id', '=', 'carts.prod_id')
            ->where('carts.prod_id', '=', $id, 'and')
            ->where('user_id', '=', Auth::id());

        $cart_name = $cart->first();
        $cart->delete();

        try {
            $x = $cart_name->prod_name;
            return redirect()->back()
                ->with('successfull', $x . ' has been removed from from cart!');
        } catch (Exception $ex) {
            return redirect()->back()
                ->with([
                    'error_title' => 'Cannot remove if not in cart',
                    'error_msg' => 'Sorry! You cannot remove a product that has not been added to cart.'
                ]);
        };

        return response()->json(['cart' => $cart_name, 'prod' => $cart_name->prod_name], 200, [], JSON_PRETTY_PRINT);
    }

    public function GetAddress($id)
    {
        $address['data'] = Customer::where('cust_id', $id)
            ->get();

        return response()->json($address, 200, [], JSON_PRETTY_PRINT);
    }

    public function EditOrder($id){
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

        return view('orders.edit', [
            'orders' => $orders,
            'order' => $order,
            'carts' => $carts,
            'staff' => $staff,
            'i' => 1,
            // 'prod_total' => $products->count(),
        ]);

    }

    public function UpdateOrder($id){
        
    }
}
