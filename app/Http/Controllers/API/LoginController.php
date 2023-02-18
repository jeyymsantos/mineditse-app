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

        if(!empty($user) && Hash::check($password, $user->password)){
            return response()->json($user, 200, [], JSON_PRETTY_PRINT);
        }else{
            echo 'Incorrect email/password';
        }

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

        $user = DB::table('users')
            ->select('*')
            ->where('email', '=', $email)
            ->get()->first();

        if(!empty($user)){
            echo 'Email already exist!';
            return;
        }

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

    public function EditCustomer(Request $req){
        
        $id = $req->id;
        $first_name = $req->first_name;
        $last_name = $req->last_name;
        $phone = $req->phone;
        
        $street = $req->street;
        $barangay = $req->barangay;
        $city = $req->city;
        $province = $req->province;

        if (is_null($first_name) || is_null($last_name) || is_null($id) || is_null($phone) || is_null($street) || is_null($barangay) || is_null($city) || is_null($province)) {
            echo 'All fields required!';
            return;
        };

        $user = User::find($id);
        if(empty($user)){
            echo 'Cannot find user!';
            return;
        }

        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->phone_number = $phone;
        $user->save();

        $customer = Customer::find($id);
        $customer->cust_street = $street;
        $customer->cust_barangay = $barangay;
        $customer->cust_city = $city;
        $customer->cust_province = $province;
        $customer->save();

        echo "Customer updated successfully!";

    }
}
