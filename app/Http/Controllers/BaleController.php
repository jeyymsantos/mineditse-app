<?php

namespace App\Http\Controllers;

use App\Models\Bale;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BaleController extends Controller
{
    public function index(){
        $bales = Bale::all();
        return view('bales.view', ['bales' => $bales]);
    }

    public function AddView(){
        $suppliers = Supplier::all();
        return view('bales.add', ['suppliers' => $suppliers]);
    }

    public function AddBale(Request $req){
        $bale = new Bale();
        $bale->bale_id = $req->id;
        $bale->bale_name = $req->name;
        $bale->supplier_id = $req->supplier;
        $bale->bale_description = $req->description;
        $bale->bale_order_date = $req->date;
        $bale->save();

        return redirect('admin/suppliers');
    }
}
