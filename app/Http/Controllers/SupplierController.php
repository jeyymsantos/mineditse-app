<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::all();
        return view('suppliers.view', compact('suppliers'));
    }

    public function add(){
        return view('suppliers.add');
    }

    public function AddCustomer(Request $req){
        $supplier = new Supplier();
        $supplier->supplier_name = $req->name;
        $supplier->supplier_address = $req->address;
        $supplier->supplier_email = $req->email;
        $supplier->supplier_phone = $req->phone;
        $supplier->supplier_other_details = $req->remarks;
        $supplier->supplier_registered_date = $req->date;
        $supplier->save();

        return redirect('admin/suppliers');
    }
}
