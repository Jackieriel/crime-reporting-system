<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\CrimeCategory;
use App\Models\Incident;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
        $title = 'Dashboard';


        return view('pages.frontend.dashboard')
            ->with('title', $title)
            ->with('total_reported_case', Incident::where('reporter_id', Auth::user()->id)->count())
            ->with('total_case_open', Incident::where('reporter_id', Auth::user()->id)->where('status', 'verified - investigation openned')->count())
            ->with('total_case_close', Incident::where('reporter_id', Auth::user()->id)->where('status', 'verified - investigation closed')->count())
            ->with('total_case_pending', Incident::where('reporter_id', Auth::user()->id)->where('status', 'pending verification')->count());
    }


    // Render form for user to report
    public function reportCase()
    {
        $title = 'Report Incident';
        $categories = CrimeCategory::all();

        return view('pages.frontend.report')
            ->with('categories', $categories)
            ->with('title', $title);
    }



    // User Report case
    public function report(Request $request)
    {
        // Validate request
        $this->validate($request, [
            'crime_category_id' => 'required',
            'lga' => 'required',
            'address' => 'required',
            'description' => 'required',
            'photo' => 'image |  | mimes:jpeg,png,jpg,gif| sometimes',
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
        return redirect()->route('report.cases');
    }



    // Reported cases
    public function reportedCases(Request $request)
    {

        $title = 'My Reported Cases';


        //fetch 5 incidents from database which are active and latest
        $incidents = Incident::where('reporter_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.frontend.reported-cases')
            ->with('title', $title)
            ->with('incidents', $incidents);
    }

    // single report
    public function singleReport($id)
    {
        $incident = Incident::with('crimecategory')->where('id', $id)->first();
        if (!$incident) {
            // flash message to session
            Session::flash('info', 'requested page not found!');

            // Redirect on success
            return redirect()->route('report.cases');
        }

        $title = 'Reported Incident';

        $feedbacks = $incident->feedbacks;

        return view('pages.frontend.single-incident')
            ->with('incident', $incident)
            ->with('feedbacks', $feedbacks)
            ->with('title', $title);
    }


    public function userStat()
    {

        $title = 'Statistics';

        return view('pages.frontend.user-stat')
            ->with('title', $title)
            ->with('total_reported_case', Incident::where('reporter_id', Auth::user()->id)->count())
            ->with('total_case_open', Incident::where('reporter_id', Auth::user()->id)->where('status', 'verified - investigation openned')->count())
            ->with('total_case_close', Incident::where('reporter_id', Auth::user()->id)->where('status', 'verified - investigation closed')->count())
            ->with('total_case_pending', Incident::where('reporter_id', Auth::user()->id)->where('status', 'pending verification')->count());
    }



    public function profile($id)
    {
        $user = User::findOrFail($id);

        $title = 'Update Profile';

        return view('pages.frontend.user-profile')
            ->with('user', $user)
            ->with('title', $title);
    }

    public function editProfile($id)
    {
        $user = User::findOrFail($id);

        $title = 'Update Profile';

        return view('pages.frontend.edit-profile')
            ->with('user', $user)
            ->with('title', $title);
    }

    public function updateProfile(Request $request, $id)
    {
        // Validate data pass
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required|min:11',
            'email' => 'required|email',
            'photo' => 'image|mimes:jpeg,png,jpg,gif| sometimes',
        ]);

        $profile = User::findOrFail($id);

        // Photo preparing
        if ($request->hasFile('photo')) {
            $photo = $request->photo;

            $photo_new_name = time() . $photo->getClientOriginalName();

            $photo->move('uploads/profile/', $photo_new_name);

            $profile->photo = 'uploads/profile/' . $photo_new_name;
        }

        $profile->name = $request->name;
        $profile->gender = $request->gender;
        $profile->phone = $request->phone;
        $profile->email = $request->email;



        // Save post
        $profile->save();

        // flash message to session
        Session::flash('success', 'Profile Updated Successfully!');

        // Redirect on success
        return redirect()->route('user.profile', Auth::user()->id);
    }

    // News

    public function news()
    {
         //fetch 5 incidents from database which are active and latest
         $announcements = Announcement::orderBy('created_at', 'desc')->paginate(10);

         $title = 'News/Announcement';
 
         return view('pages.frontend.news')
             ->with('announcements', $announcements)
             ->with('title', $title);
    }

    public function singleNews($id)
    {
        $announcement = Announcement::where('id', $id)->first();
        if (!$announcement) {
            // flash message to session
            Session::flash('info', 'requested page not found!');

            // Redirect on success
            return redirect()->route('news');
        }

        $title = 'Announcement';


        return view('pages.frontend.single-news')
            ->with('announcement', $announcement)
            ->with('title', $title);
    }
}
