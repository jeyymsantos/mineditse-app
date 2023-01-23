<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> 118cfe519665c6df7e4deb7256a8e9abbaca4b66

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
<<<<<<< HEAD
        return view('home');
=======
        if(Auth::user()->role == 'admin'){
            return redirect('/admin');
        }else{
            return redirect('/customer');
        }
>>>>>>> 118cfe519665c6df7e4deb7256a8e9abbaca4b66
    }
}
