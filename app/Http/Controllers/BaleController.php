<?php

namespace App\Http\Controllers;

use App\Models\Bale;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaleController extends Controller
{
    public function index()
    {
        // $bales = Bale::all();
        $bales = DB::table('bales')
        ->select('bale_id', 'bale_price', 'bale_quantity', 'categories.category_name', 'suppliers.supplier_name', 'bale_description', 'bale_order_date')
        ->join('categories', 'bales.category_id', '=', 'categories.category_id')
        ->join('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')
        ->get();
        return view('bales.view', ['bales' => $bales]);
    }

    public function AddView()
    {
        $lastBale = Bale::orderBy('bale_id', 'desc')->first();
        $suppliers = Supplier::all();
        $categories = Category::all();

        $bales = Bale::all();

        return view('bales.add', [
            'suppliers' => $suppliers,
            'categories' => $categories,
            'lastBale' => $lastBale,
            'bales' => $bales
        ]);
    }

    public function AddBale(Request $req)
    {
        $bale = new Bale();
        $bale->bale_id = $req->id;
        $bale->category_id = $req->category;
        $bale->supplier_id = $req->supplier;
        $bale->bale_price = $req->price;
        $bale->bale_quantity = $req->quantity;
        $bale->bale_description = $req->description;
        $bale->bale_order_date = $req->date;
        $bale->save();

        return redirect('admin/bales');
    }

    public function innerJoin(){
        $result = DB::table('bales')
        ->join('categories', 'bales.category_id', '=', 'categories.category_id')
        ->join('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')
        ->select('bale_id', 'categories.category_name', 'suppliers.supplier_name', 'bale_description', 'bale_order_date')
        ->get();

        return $result;
    }
}
