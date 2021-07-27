<?php

namespace App\Http\Controllers;

use App\Models\CrimeCategory;
use App\Models\Incident;
use Illuminate\Http\Request;
use App\User;
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
        $this->middleware(['auth', 'verified']);
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

            $user = User::all();
            $Incidents = Incident::where('status', 'pending verification')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();            

            return view('home')
                ->with('incidents', $Incidents)
                ->with('category_count', CrimeCategory::all()->count())
                ->with('total_reported_case', Incident::all()->count())
                ->with('total_case_open', Incident::where('status', 'verified - investigation openned')->count())
                ->with('total_case_close', Incident::where('status', 'verified - investigation closed')->count());
        }
    }
}
