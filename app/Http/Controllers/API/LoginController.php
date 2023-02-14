<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function GetCustomers(){
        $users = DB::table('customers')
        ->select('*')
        ->join('users', 'users.id', '=', 'customers.cust_id')
        ->get();

        return response()->json($users, 200, [], JSON_PRETTY_PRINT);
    }
}
