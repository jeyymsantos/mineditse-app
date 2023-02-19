<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = DB::table('suppliers')->get();
        return view('suppliers.view', ['suppliers' => $suppliers]);
    }

    public function AddView()
    {
        return view('suppliers.add');
    }

    public function AddSupplier(Request $req)
    {
        $supplier = new Supplier();
        $supplier->supplier_name = $req->name;
        $supplier->supplier_address = $req->address;
        $supplier->supplier_phone = $req->phone;
        $supplier->supplier_other_details = $req->remarks;
        $supplier->supplier_registered_date = $req->date;
        $supplier->save();

        return redirect('admin/suppliers')
            ->with('successfull', $req->name . ' has been successfully added!');
    }

    public function DeleteSupplier($id)
    {
        $supplier = Supplier::find($id);

        try {
            $supplier->delete();
            return redirect('admin/suppliers')
                ->with('successfull', $supplier['supplier_name'] . ' has been successfully deleted!');
        } catch (Exception $ex) {
            return redirect('admin/suppliers')
                ->with('error_title', 'Cannot Delete ' . $supplier['supplier_name'])
                ->with('error_msg', 'Supplier cannot be deleted. There are connected data on this value.');
        }
    }

    public function ShowSupplier($id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers.edit', ['supplier' => $supplier]);
    }

    public function EditSupplier(Request $req, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->supplier_name =              $req->name;
        $supplier->supplier_address =           $req->address;
        $supplier->supplier_phone =             $req->phone;
        $supplier->supplier_other_details =     $req->remarks;
        $supplier->supplier_registered_date =   $req->date;
        $supplier->save();

        // return redirect('admin/suppliers');
        return redirect('admin/suppliers')
            ->with('successfull', $supplier['supplier_name'] . ' has been successfully edited!');
    }
}
