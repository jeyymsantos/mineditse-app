<?php

namespace App\Http\Controllers;

use App\Models\Bale;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.view', ['products' => $products]);
    }

    public function AddView()
    {
        $bales = Bale::all();
        return view('products.add', [
            'bales' => $bales
        ]);
    }

    public function AddProduct(Request $req){
        $product = new Product();
        $product->prod_name = $req->name;
        $product->bale_id = $req->bale;
        $product->prod_description = $req->description;
        $product->prod_price = $req->price;
        $product->prod_unit = $req->unit;
        $product->prod_quantity = $req->quantity;
        $product->prod_status = $req->status;
        $product->prod_other_details = $req->other;

        if($req->hasFile('photo')){
            $destination_path = 'public/images/products';
            $image = $req->file('photo');
            $image_name = $req->name.'_'.$image->getClientOriginalName();
            
            $req->file('photo')->storeAs($destination_path, $image_name);
            $product->prod_img_path = $destination_path."/".$image_name;
        }else {
            $product->prod_img_path = '/storage/images/product.png';
        }

        $product->save();

        return redirect('/admin/products');
    }
}
