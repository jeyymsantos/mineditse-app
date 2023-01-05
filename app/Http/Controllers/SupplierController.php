<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::all();
        return view('suppliers.view', ['suppliers' => $suppliers]);
    }

    public function add(){
        return view('suppliers.add');
    }

    public function AddSupplier(Request $req){
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

    public function DeleteSupplier($id){
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect('admin/suppliers');
    }

    public function ShowSupplier($id){
        $supplier = Supplier::find($id);
        return view('suppliers.edit', ['supplier' => $supplier]);
    }

    public function EditSupplier(Request $req, $id){
        $supplier = Supplier::find($id);
        $supplier->supplier_name =              $req->name;
        $supplier->supplier_address =           $req->address;
        $supplier->supplier_email =             $req->email;
        $supplier->supplier_phone =             $req->phone;
        $supplier->supplier_other_details =     $req->remarks;
        $supplier->supplier_registered_date =   $req->date;
        $supplier->save();

        return redirect('admin/suppliers');
    }
}
