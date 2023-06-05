<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $info = Info::all()->first();
        if (Auth::user()->role == 'admin' || Auth::user()->role == "staff") {

            return redirect('/admin')->with(['info' => $info,]);
        } else {
            return redirect('/customer')->with(['info' => $info,]);
        }
    }
}
