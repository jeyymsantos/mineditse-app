<?php

namespace App\Http\Controllers;

use App\Models\Bale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
            ->select('*', 'categories.category_id')
            ->join('bales', 'products.bale_id', '=', 'bales.bale_id')
            ->join('categories', 'bales.category_id', '=', 'categories.category_id')
            ->orderBy('prod_id')
            ->get();

        $products = DB::table('products')
            ->select('*', 'categories.category_id')
            ->join('bales', 'products.bale_id', '=', 'bales.bale_id')
            ->join('categories', 'bales.category_id', '=', 'categories.category_id')
            ->orderBy('prod_id')
            ->get();

        return view('products.view', [
            'products' => $products,
            'prod_total' => $products->count()
        ]);
    }

    public function AddView()
    {
        $bales = DB::table('bales')
            ->select('bale_id', 'categories.category_name', 'suppliers.supplier_name', 'bale_description', 'bale_order_date')
            ->join('categories', 'bales.category_id', '=', 'categories.category_id')
            ->join('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')
            ->get();
        return view('products.add', [
            'bales' => $bales,
        ]);
    }

    public function AddProduct(Request $req)
    {
        $product = new Product();
        $product->prod_name = $req->name;
        $product->prod_qr_code = $req->id;
        $product->bale_id = $req->bale;
        $product->prod_price = $req->price;
        $product->prod_unit = $req->unit;
        $product->prod_other_details = $req->other;

        if ($req->hasFile('photo')) {
            $destination_path = 'public/images/products';
            $image = $req->file('photo');
            $image_name = $req->id . '_' . $req->name;

            $req->file('photo')->storeAs($destination_path, $image_name);
            $product->prod_img_path = 'storage/images/products/' . $image_name;
        } else {
            $product->prod_img_path = 'storage/images/product.png';
        }

        $product->save();

        return redirect('/admin/products')->with('successfull', $product->prod_name . ' has been successfully added!');
    }

    public function ViewBarcode()
    {
        $bales = DB::table('bales')
            ->select('bale_id', 'categories.category_name', 'suppliers.supplier_name', 'bale_description', 'bale_order_date')
            ->join('categories', 'bales.category_id', '=', 'categories.category_id')
            ->join('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')
            ->get();

        return view('products.barcode', [
            'bales' => $bales,
            'unique' => $this->unique_code(9),
        ]);
    }

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

}
