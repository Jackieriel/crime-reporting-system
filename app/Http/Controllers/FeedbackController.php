<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\User;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'on_incident' => 'required',

        ]);

        $feedback = Feedback::create([
            'from_user' => $request->user()->id,
            'on_incident' => $request->on_incident,
            'body' => $request->body,
        ]);        

        $data = [            
            'name' => $request->name,            
            'email' => $request->email,            
            // 'name' => Auth::user()->name,
            
        ];        

        // Send email to the admin

        Mail::send(
            'pages.frontend.feedback-email',
            $data,

            function ($sendEmail) use ($request) {
                $sendEmail->from('reports@tesscrystem.com', 'TessCRSystem');
                $sendEmail->to($request->email, 'Hello '. $request->name)->subject('Crime Incident Report Feedback');
            }
        );



        // flash message to session
        Session::flash('success', 'Remark added successfully!');

        // Redirect on success
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
