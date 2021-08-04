<?php

namespace App\Http\Controllers;

use App\Models\CrimeCategory;
use App\Models\Incident;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Charts\CrimeStat;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::all();

        if ($user && ($request->user()->is_super_admin() ||
            $request->user()->is_security_agency() ||
            $request->user()->is_other_agency())) {
            //fetch 5 incidents from database which are active and latest
            $incidents = Incident::orderBy('created_at', 'desc')->paginate(10);
            $title = 'All Incidents';

            return view('pages.admin.incident.index')
                ->with('incidents', $incidents)
                ->with('title', $title);
        } else {
            Session::flash('error', 'Invalid Operation. You have not sufficient permissions');
            return redirect('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // 
        if ($request->user()->can_report()) {
            $categories = CrimeCategory::all();
            $title = 'Report New Incident';

            if ($categories->count() == 0) {
                Session::flash('info', 'There must be  a crime category  before you can report.');

                return redirect()->back();
            }

            return view('pages.admin.incident.create')
                ->with('categories', $categories)
                ->with('title', $title);
        } else {

            // flash message to session
            Session::flash('error', 'You have not sufficient permissions for Reporting');

            return redirect('/')->withErrors('You have not sufficient permissions for Reporting');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Assign variable for request
        // $r = request();

        // Validate request
        $this->validate($request, [
            'crime_category_id' => 'required',
            'lga' => 'required',
            'address' => 'required',
            'description' => 'required',
            'photo' => 'image | mimes:jpeg,png,jpg,gif| sometimes',
            'video' => 'video | sometimes',

        ]);

        // Photo preparing
        if ($request->hasFile('photo')) {
            $photo = $request->photo;

            $photo_new_name = time() . $photo->getClientOriginalName();

            $photo->move('uploads/evidence/images', $photo_new_name);


            // $photo = 'uploads/evidence/images/' . $photo_new_name;
        }

        if ($request->hasFile('video')) {
            // Video preparing
            $video = $request->video;

            $video_new_name = time() . $video->getClientOriginalName();

            $video->move('uploads/evidence/video', $video_new_name);

            // $video = 'uploads/evidence/video' . $video_new_name;
        }


        // ddd(request()->all());

        // Save the rest of the content

        if ($request->hasFile('photo') && $request->hasFile('video')) {
            $incident = Incident::create([
                'reporter_id' => $request->user()->id,
                'crime_category_id' => $request->crime_category_id,

                'lga' => request()->lga,
                'address' => $request->address,
                'description' => $request->description,

                'photo' => 'uploads/evidence/images/' . $photo_new_name,
                'video' => 'uploads/evidence/video' . $video_new_name,

            ]);
        } elseif ($request->hasFile('photo')) {
            $incident = Incident::create([
                'reporter_id' => $request->user()->id,
                'crime_category_id' => $request->crime_category_id,

                'lga' => request()->lga,
                'address' => $request->address,
                'description' => $request->description,

                'photo' => 'uploads/evidence/images/' . $photo_new_name,

            ]);
        } elseif ($request->hasFile('video')) {
            $incident = Incident::create([
                'reporter_id' => $request->user()->id,
                'crime_category_id' => $request->crime_category_id,

                'lga' => request()->lga,
                'address' => $request->address,
                'description' => $request->description,

                'video' => 'uploads/evidence/video/' . $video_new_name,

            ]);
        } else {
            $incident = Incident::create([
                'reporter_id' => $request->user()->id,
                'crime_category_id' => $request->crime_category_id,

                'lga' => request()->lga,
                'address' => $request->address,
                'description' => $request->description,

            ]);
        }



        // flash message to session
        Session::flash('success', 'Incident Reported successfully!');

        // Redirect on success
        return redirect()->route('incident.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incident = Incident::with('crimecategory')->where('id', $id)->first();
        if (!$incident) {
            // flash message to session
            Session::flash('info', 'requested page not found!');

            // Redirect on success
            return redirect()->route('incident.index');
        }

        $title = 'Reported Incident';

        $feedbacks = $incident->feedbacks;

        return view('pages.admin.incident.show')
            ->with('incident', $incident)
            ->with('feedbacks', $feedbacks)
            ->with('title', $title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incident = Incident::findOrFail($id);

        $categories = CrimeCategory::all();
        $title = 'Update Reported Incident';

        return view('pages.admin.incident.edit')
            ->with('incident', $incident)
            ->with('categories', $categories)
            ->with('title', $title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate data pass
        $this->validate($request, [
            'status' => 'required',
            'crime_category_id' => 'required'
        ]);

        // find the post
        $incident = Incident::findOrFail($id);

        $incident->status = $request->status;
        $incident->crime_category_id = $request->crime_category_id;

        // Save post
        $incident->save();

        // Flash message
        Session::flash('success', 'Reported Incident updated successfully!');

        // redirect
        return redirect()->route('incident.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $incident = Incident::findOrFail($id);

        if ($incident && ($incident->reporter_id == $request->user()->id
            || $request->user()->is_security_agency()
            || $request->user()->is_super_admin())) {

            // if (file_exists(public_path($incident->photo))) {
            //     unlink(public_path($incident->photo));
            // }

            Incident::destroy($id);

            Session::flash('success', 'Incident deleted successfully!');
        } else {
            Session::flash('error', 'Invalid Operation. You have not sufficient permissions');
        }
        return redirect()->route('incident.index');
    }



    public function crimeStats()
    {


        $title = 'Crime Statistics';


        // $categories = CrimeCategory::with('incidents')->pluck('category_name');


        $categories = CrimeCategory::with('incidents')->get();

        $var = [];
        $var2 = [];
        foreach ($categories as $crimes) {
            $var[] = $crimes->category_name;
            $var2[] = $crimes->incidents->count();
        };

        // new instant of crime stat
        $chart = new CrimeStat;

        $chart->labels($var);
        $chart->dataset('Total Reported Incident', 'bar', $var2)
            ->color("#3490dc")
            ->backgroundcolor("#3490dc");

        return view('pages.frontend.chartview')
            ->with('chart', $chart)
            ->with('title', $title)
            ->with('category_count', CrimeCategory::all()->count())
            ->with('total_reported_case', Incident::all()->count())
            ->with('total_case_open', Incident::where('status', 'verified - investigation openned')->count())
            ->with('total_case_close', Incident::where('status', 'verified - investigation closed')->count());
    }


    // search incidents

    public function searchIncident()
    {
        // $title = "Search Result";

        $incidents = Incident::where('address', 'like', '%' . request('search') . '%')
            ->orWhere('lga', 'like', '%' . request('search') . '%')        
            // ->orWhere($incidents->repoter->name, 'like', '%' . request('search') . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(15);;
        
            

        return view('pages.admin.incident.result')
            ->with('incidents', $incidents)
            ->with('title', 'Search results  for: ' . request('search'));
    }
}
