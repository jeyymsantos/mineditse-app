<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function GetCustomers(){
        $users = DB::table('customers')
        ->select('*')
        ->join('users', 'users.id', '=', 'customers.cust_id')
        ->get();

        return response()->json($users, 200, [], JSON_PRETTY_PRINT);
    }

    public function GetProducts(){
        $products = DB::table('products')
        ->select('*')
        ->get();

        return response()->json($products, 200, [], JSON_PRETTY_PRINT);
    }

    public function LoginCustomer(Request $req){

        $email = $req->email;
        $password = $req->password;

        if(is_null($email) || is_null($password)){
            echo 'All fields required!';
            return;
        };

        $user = DB::table('customers')
        ->select('*')
        ->join('users', 'users.id', '=', 'customers.cust_id')
        ->where('email', '=', $email)
        ->get()->first();

        if(Hash::check($password, $user->password)){
            return response()->json($user, 200, [], JSON_PRETTY_PRINT);
        }

        echo 'Account not found';
        
    }

    public function GetOrder($id){
        $order = DB::table('orders')
        ->select('*')
        ->join('customers', 'customers.cust_id', '=', 'orders.cust_id')
        ->join('users', 'customers.cust_id', '=', 'users.id')
        ->orderBy('order_date', 'desc')
        ->where('orders.cust_id', '=',$id)->get();

        return response()->json($order, 200, [], JSON_PRETTY_PRINT);
    }
    
}
