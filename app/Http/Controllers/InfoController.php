<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {

        $info = Info::all()->first();
        return view('welcome', [
            'info' => $info,
        ]);
    }
}
