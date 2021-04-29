<?php

namespace App\Http\Controllers;

use App\Models\CrimeCategory;
use App\Models\Incident;
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
        if (Auth::user()->is_reporter()) {

            return redirect()->route('dashboard')
                ->with('category_count', CrimeCategory::all()->count());
        } else {
            return view('home')
                ->with('category_count', CrimeCategory::all()->count())
                ->with('total_reported_case', Incident::all()->count())
                ->with('total_case_open', Incident::where('status', 'verified - investigation openned')->count())
                ->with('total_case_close', Incident::where('status', 'verified - investigation closed')->count());
        }
    }
}
