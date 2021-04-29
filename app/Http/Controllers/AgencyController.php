<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch 5 incidents from database which are active and latest
        $agencies = Agency::orderBy('created_at', 'desc')->paginate(10);

        $title = 'Agency';

        return view('pages.admin.agency.index')
            ->with('agencies', $agencies)
            ->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = User::all();

        $title = 'Create Agency Profile';

        return view('pages.admin.agency.create')
            ->with('users', $users)
            ->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request
        $this->validate($request, [
            'agent_id' => 'required',
            'phone' => 'required',
            'website' => 'required |url',
            'email' => 'required |email',
            'about' => 'required',
        ]);

        $incident = Agency::create([
            'agent_id' => $request->agent_id,
            'agency_name' => $request->agency_name,
            'phone' => $request->phone,
            'website' => $request->website,
            'email' => $request->email,
            'about' => $request->about,

        ]);

        // flash message to session
        Session::flash('success', 'Agency Profile Created successfully!');

        // Redirect on success
        return redirect()->route('agency.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agency = Agency::with('agent')->where('id', $id)->first();
        if (!$agency) {
            // flash message to session
            Session::flash('info', 'requested page not found!');

            // Redirect on success
            return redirect()->route('agency.index');
        }

        $title = 'Agency Profile';


        return view('pages.admin.agency.show')
            ->with('agency', $agency)
            ->with('title', $title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agency = Agency::findOrFail($id);

        $title = 'Update Agency Profile';

        return view('pages.admin.agency.edit')
            ->with('agency', $agency)
            ->with('title', $title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate request
        $this->validate($request, [
            'agent_id' => 'required|sometimes',
            'phone' => 'required',
            'website' => 'required |url',
            'email' => 'required |email',
            'about' => 'required',
        ]);

        // find the post
        $agency = Agency::findOrFail($id);


        $agency->phone = $request->phone;
        $agency->website = $request->website;
        $agency->email = $request->email;
        $agency->about = $request->about;


        // Save post
        $agency->save();

        // Flash message
        Session::flash('success', 'Agency Profile updated successfully!');

        // redirect
        return redirect()->route('agency.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $agency = Agency::findOrFail($id);

        if ($agency && ($agency->agent_id == $request->user()->id
            || $request->user()->is_super_admin())) {

            Agency::destroy($id);

            Session::flash('success', 'Agency profile deleted successfully!');
        } else {
            Session::flash('error', 'Invalid Operation. You have not sufficient permissions');
        }

        return redirect()->route('agency.index');
    }
}
