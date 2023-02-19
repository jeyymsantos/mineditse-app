<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function ShowCart(Request $req)
    {
        $products = Product::all();

        $carts = DB::table('carts')
            ->select('*')
            ->join('products', 'products.prod_id', '=', 'carts.prod_id')
            ->where('user_id', '=', Auth::id())->get();

        $customers = DB::table('users')
            ->select('*')
            ->join('customers', 'users.id', '=', 'customers.cust_id')
            ->get();

        return view('customers.cart.view')->with([
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
}
