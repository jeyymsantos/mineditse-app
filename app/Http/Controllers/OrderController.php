<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    public function index(Request $req)
    {
        $search = $req->search;

        $products = DB::table('products')
            ->select('*', 'products.bale_id', 'categories.category_name', 'suppliers.supplier_name')
            ->leftJoin('bales', 'products.bale_id', '=', 'bales.bale_id')
            ->leftJoin('categories', 'bales.category_id', '=', 'categories.category_id')
            ->leftJoin('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')

            ->orderBy('prod_id')
            ->orWhere(function ($query) use ($search) {
                $query->where('prod_name', 'LIKE', '%' . $search . '%', 'or');
                $query->where('prod_price', 'LIKE', '%' . $search . '%', 'or');
                $query->where('prod_qr_code', 'LIKE', '%' . $search . '%', 'or');
                $query->where('products.bale_id', 'LIKE', '%' . $search . '%', 'or');
                $query->where('prod_status', 'LIKE', '%' . $search . '%', 'or');
            })
            ->where('prod_deleted', '=', '0', 'and')
            ->paginate(10)->withQueryString();

        return view('orders.view', [
            'products' => $products,
            'search' => $search,
            'i' => 1,
            // 'prod_total' => $products->count(),
        ]);
    }

    public function ShowProducts(Request $req)
    {
        $search = $req->search;

        $products = DB::table('products')
            ->select('*', 'products.bale_id', 'categories.category_name', 'suppliers.supplier_name')
            ->leftJoin('bales', 'products.bale_id', '=', 'bales.bale_id')
            ->leftJoin('categories', 'bales.category_id', '=', 'categories.category_id')
            ->leftJoin('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')

            ->orderBy('prod_id')
            ->orWhere(function ($query) use ($search) {
                $query->where('prod_name', 'LIKE', '%' . $search . '%', 'or');
                $query->where('prod_price', 'LIKE', '%' . $search . '%', 'or');
                $query->where('prod_qr_code', 'LIKE', '%' . $search . '%', 'or');
                $query->where('products.bale_id', 'LIKE', '%' . $search . '%', 'or');
            })
            ->where('prod_deleted', '=', '0', 'and')
            ->where('prod_status', '=', 'Available')
            ->paginate(10)->withQueryString();

        $carts = DB::table('carts')
            ->where('user_id', '=', Auth::id())->get();

        return view('orders.add', [
            'products' => $products,
            'search' => $search,
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
                $cart->prod_name = $product->prod_name;
                $cart->prod_qr_code = $product->prod_qr_code;
                $cart->prod_img_path = $product->prod_img_path;
                $cart->prod_price = $product->prod_price;
                $cart->save();

                return redirect()->route('add_orders')
                    ->with('successfull', $product->prod_name . ' has been successfully added to cart!');
            } else {
                return redirect()->route('add_orders')
                    ->with([
                        'error_title' => 'Product Unavailable',
                        'error_msg' => 'Sorry! You cannot add a product that is not available.'
                    ]);
            }
        }

        return response()->json(['cart' => $cart], 200, [], JSON_PRETTY_PRINT);
    }

    public function ShowCart(Request $req)
    {
        $search = $req->search;
        $products = Product::all();

        $carts = DB::table('carts')
            ->select('*')
            ->where('user_id', '=', Auth::id())
            ->paginate(10)->withQueryString();


        $customers = DB::table('users')
            ->select('name', 'email', 'customers.cust_type')
            ->join('customers', 'users.id', '=', 'customers.cust_id')
            ->paginate(10)->withQueryString();

        return view('orders.cart', [
            'carts' => $carts,
            'search' => $search,
            'products' => $products,
            'i' => 1,
            'carts' => $carts,
            'customers' => $customers
        ]);
    }

    public function RemoveFromCart($id)
    {

        $cart = DB::table('carts')
            ->where('prod_id', '=', $id, 'and')
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
