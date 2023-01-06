<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.landing_page', ['suppliers' => $suppliers]);
    }
}
