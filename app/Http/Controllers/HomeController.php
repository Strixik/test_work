<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function role()
    {
        return view('role');
    }

    public function page1()
    {
        return view('page1');
    }

    public function page2()
    {
        return view('page2');
    }
}
