<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function GetCustomers()
    {
        $users = DB::table('customers')
            ->select('*')
            ->join('users', 'users.id', '=', 'customers.cust_id')
            ->get();

        return response()->json($users, 200, [], JSON_PRETTY_PRINT);
    }

    public function GetProducts()
    {
        $products = DB::table('products')
            ->select('*')
            ->get();

        return response()->json($products, 200, [], JSON_PRETTY_PRINT);
    }

    public function LoginCustomer(Request $req)
    {

        $email = $req->email;
        $password = $req->password;

        if (is_null($email) || is_null($password)) {
            echo 'All fields required!';
            return;
        };

        $user = DB::table('customers')
            ->select('*')
            ->join('users', 'users.id', '=', 'customers.cust_id')
            ->where('email', '=', $email)
            ->get()->first();

        if (Hash::check($password, $user->password)) {
            return response()->json($user, 200, [], JSON_PRETTY_PRINT);
        }

        echo 'Account not found';
    }

    public function GetOrder(Request $req)
    {

        $id = $req->id;
        if (is_null($id)) {
            echo 'ID required!';
            return;
        };

        $order = DB::table('orders')
            ->select('*')
            ->join('customers', 'customers.cust_id', '=', 'orders.cust_id')
            ->join('users', 'customers.cust_id', '=', 'users.id')
            ->orderBy('order_date', 'desc')
            ->where('orders.cust_id', '=', $id)->get();

        if (is_null($order->first())) {
            echo 'No Transactions Found';
            return;
        }

        return response()->json($order, 200, [], JSON_PRETTY_PRINT);
    }

    public function CreateCustomer(Request $req)
    {
        $name = $req->name;
        $phone = $req->phone;
        $email = $req->email;
        $password = $req->password;
        $street = $req->street;
        $barangay = $req->barangay;
        $city = $req->city;
        $province = $req->province;

        if (is_null($email) || is_null($password) || is_null($name) || is_null($phone) || is_null($street) || is_null($barangay) || is_null($city) || is_null($province)) {
            echo 'All fields required!';
            return;
        };

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone,
            'password' => Hash::make($password),
        ]);

        Customer::create([
            'cust_id' => $user->id,
            'cust_street' => $street,
            'cust_barangay' => $barangay,
            'cust_city' => $city,
            'cust_province' => $province,
        ]);

        echo 'Customer saved successfully!';
    }
}
