<?php

namespace App\Http\Controllers;

use App\Models\Bale;
use App\Models\Category;
use App\Models\Supplier;
use Exception;
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
        ->paginate(10)->withQueryString();

        return view('bales.view', [
            'bales' => $bales,
        ]);
    }

    public function AddView()
    {
        $lastBale = Bale::orderBy('bale_id', 'desc')->first();
        $suppliers = Supplier::orderBy('supplier_name')->get();
        $categories = Category::orderBy('category_name')->get();
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

        return redirect('admin/bales')->with('successfull', 'Bale '. $bale->bale_id . ' has been successfully added!');
    }

    public function innerJoin(){
        $result = DB::table('bales')
        ->join('categories', 'bales.category_id', '=', 'categories.category_id')
        ->join('suppliers', 'bales.supplier_id', '=', 'suppliers.supplier_id')
        ->select('bale_id', 'categories.category_name', 'suppliers.supplier_name', 'bale_description', 'bale_order_date')
        ->get();

        return $result;
    }

    public function DeleteBale($id)
    {
        $bale = Bale::find($id);

        try {
            $bale->delete();
            return redirect('admin/bales')
                ->with('successfull', 'Bale ' . $bale['bale_id'] . ' has been successfully deleted!');
        } catch (Exception $ex) {
            return redirect('admin/bales')
                ->with('error_title', 'Cannot Delete Bale ' . $bale['bale_id'])
                ->with('error_msg', 'Bale cannot be deleted. There are connected data on this value.');
        }
    }

    public function ShowBale($id)
    {
        $bale = Bale::find($id);
        $suppliers = Supplier::orderBy('supplier_name')->get();
        $categories = Category::orderBy('category_name')->get();

        return view('bales.edit', [
            'suppliers' => $suppliers,
            'categories' => $categories,
            'bale' => $bale
        ]);
    }

    public function EditBale(Request $req, $id)
    {
        $bale = Bale::find($id);
        $bale->category_id =            $req->category;
        $bale->supplier_id =            $req->supplier;
        $bale->bale_price =             $req->price;
        $bale->bale_quantity =          $req->quantity;
        $bale->bale_description =       $req->description;
        $bale->bale_order_date =        $req->date;
        $bale->save();

        // return redirect('admin/suppliers');
        return redirect('admin/bales')
            ->with('successfull', 'Bale ' . $bale['bale_id'] . ' has been successfully edited!');
    }
}
