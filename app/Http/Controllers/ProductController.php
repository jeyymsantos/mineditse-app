<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $req)
    {
        $products = DB::table('products')
            ->select('*', 'products.bale_id', 'categories.category_name', 'suppliers.supplier_name')
            ->leftJoin('bales', 'products.bale_id', '=', 'bales.bale_id')
            ->leftJoin('categories', 'bales.category_id', '=', 'categories.category_id')
            ->leftJoin('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')

            ->orderBy('prod_id', 'desc')
            ->where('prod_deleted', '=', '0', 'and')->get();

        return view('products.view', [
            'products' => $products,
            'i' => 1,
        ]);
    }

    public function archieve(Request $req)
    {
        $search = $req->search;

        // $products = DB::table('products')
        //     ->select('*', 'categories.category_id')
        //     ->join('bales', 'products.bale_id', '=', 'bales.bale_id')
        //     ->join('categories', 'bales.category_id', '=', 'categories.category_id')
        //     ->orderBy('prod_id')
        //     ->where('prod_deleted', '=', '1')
        //     ->get();

        $products = DB::table('products')
            ->select('*', 'categories.category_id')
            ->join('bales', 'products.bale_id', '=', 'bales.bale_id')
            ->join('categories', 'bales.category_id', '=', 'categories.category_id')
            ->orderBy('prod_id')
            ->orWhere(function ($query) use ($search) {
                $query->where('prod_name', 'LIKE', '%' . $search . '%', 'or');
                $query->where('prod_price', 'LIKE', '%' . $search . '%', 'or');
                $query->where('prod_qr_code', 'LIKE', '%' . $search . '%', 'or');
                $query->where('products.bale_id', 'LIKE', '%' . $search . '%', 'or');
                $query->where('prod_status', 'LIKE', '%' . $search . '%', 'or');
            })
            ->where('prod_deleted', '=', '1', 'and')
            ->get();

        return view('products.archieve', [
            'products' => $products,
            'search' => $search,
            'i' => 1,
        ]);
    }

    public function RestoreAllProduct()
    {
        $products = Product::all();

        foreach ($products as $product) {
            $product->prod_deleted = 0;
            $product->save();
        }

        return redirect('admin/products')
            ->with('successfull', 'All products have been successfully restored!');
    }

    public function ViewProduct($id)
    {
        $product = DB::table('products')
            ->select('*', 'products.bale_id', 'categories.category_name', 'suppliers.supplier_name')
            ->leftJoin('bales', 'products.bale_id', '=', 'bales.bale_id')
            ->leftJoin('categories', 'bales.category_id', '=', 'categories.category_id')
            ->leftJoin('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')
            ->where('prod_id', '=', $id)
            ->first();

        // return response()->json([
        //     'product' => $product,
        // ], 200, [], JSON_PRETTY_PRINT);

        return view('products.view_specific', [
            'product' => $product,
        ]);
    }

    public function ShowProduct($id)
    {
        $product = Product::find($id);
        $bales = DB::table('bales')
            ->select('bale_id', 'categories.category_name', 'suppliers.supplier_name', 'bale_description', 'bale_order_date')
            ->join('categories', 'bales.category_id', '=', 'categories.category_id')
            ->join('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')
            ->get();

        return view('products.edit', [
            'product' => $product,
            'bales' => $bales
        ]);
    }

    public function DeleteProduct($id)
    {
        $product = Product::find($id);
        $product->prod_deleted = 1;
        $product->save();

        return redirect('admin/products')
            ->with('successfull', $product['prod_name'] . ' has been successfully deleted!');
    }

    public function RestoreProduct($id)
    {
        $product = Product::find($id);
        $product->prod_deleted = 0;
        $product->save();

        return redirect('admin/products')
            ->with('successfull', $product['prod_name'] . ' has been successfully restored!');
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
            'unique' => $this->unique_code(9)
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
        $product->prod_desc = $req->description;
        $product->prod_other_details = $req->other;

        if ($req->hasFile('photo')) {
            $destination_path = '/images/products';
            $image = $req->file('photo');
            $image_name = $req->id . '_' . $req->name;

            $req->file('photo')->storeAs($destination_path, $image_name);
            $product->prod_img_path = '/storage/images/products/' . $image_name;
        } else {
            $product->prod_img_path = '/storage/images/product.png';
        }

        $product->save();

        return redirect('/admin/products')->with('successfull', $product->prod_name . ' has been successfully added!');
    }

    public function EditProduct(Request $req, $id)
    {
        $product = Product::find($id);
        $product->prod_name = $req->name;
        $product->prod_status = $req->activation;
        $product->bale_id = $req->bale;
        $product->prod_price = $req->price;
        $product->prod_unit = $req->unit;
        $product->prod_desc = $req->description;
        $product->prod_other_details = $req->other;

        if ($req->hasFile('photo')) {
            $destination_path = '/images/products';
            $image = $req->file('photo');
            $image_name = $req->id . '_' . $req->name;

            $req->file('photo')->storeAs($destination_path, $image_name);
            $product->prod_img_path = '/storage/images/products/' . $image_name;
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
