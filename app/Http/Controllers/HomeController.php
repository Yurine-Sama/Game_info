<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->email == 'admin@admin.com') {
            return redirect('/admin');
        } else {
            return view('home');
        }
    }

    public function admin_controller()
    {
        if (Auth::user()->email != 'admin@admin.com') {
            return redirect('/home');
        } else {
            return view('admin');
        }
    }

    public function search_controller()
    {
        return view('search');
    }

    public function admin_checkout()
    {
        if (Auth::user()->email != 'admin@admin.com') {
            return redirect('/home');
        } else {
            return view('orders.checkout');
        }
    }

    public function admin_orderCheck()
    {
        if (Auth::user()->email != 'admin@admin.com') {
            return redirect('/home');
        } else {
            return view('orders.checkOrder');
        }
    }
}
