<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect()->route('home');
        }

        return view('pages.frontend.index');
    }

    public function dashboard()
    {
        return view('pages.frontend.dashboard');
    }
}
