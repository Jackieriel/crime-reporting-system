<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch 5 incidents from database which are active and latest
        $announcements = Announcement::orderBy('created_at', 'desc')->paginate(10);

        $title = 'Announcement';

        return view('pages.admin.announcement.index')
            ->with('announcements', $announcements)
            ->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title = 'Post Announcement';

        return view('pages.admin.announcement.create')
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
            'title' => 'required',            
            'description' => 'required',
            'status' => 'required',
        ]);

        $announcement = Announcement::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'status' => $request->status,

        ]);

        // flash message to session
        Session::flash('success', 'Announcement Posted successfully!');

        // Redirect on success
        return redirect()->route('announcement.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $announcement = Announcement::where('id', $id)->first();
        if (!$announcement) {
            // flash message to session
            Session::flash('info', 'requested page not found!');

            // Redirect on success
            return redirect()->route('announcement.index');
        }

        $title = 'Announcement';


        return view('pages.admin.announcement.show')
            ->with('announcement', $announcement)
            ->with('title', $title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);

        $title = 'Update Announcement';

        return view('pages.admin.announcement.edit')
            ->with('announcement', $announcement)
            ->with('title', $title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate request
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        // find the post
        $announcement = Announcement::findOrFail($id);


        $announcement->title = $request->title;
        $announcement->slug = Str::slug($request->title);
        $announcement->description = $request->description;
        $announcement->status = $request->status;


        // Save post
        $announcement->save();

        // Flash message
        Session::flash('success', 'Announcement updated successfully!');

        // redirect
        return redirect()->route('announcement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $announcement = Announcement::findOrFail($id);

        Announcement::destroy($id);

        Session::flash('success', 'Announcement deleted successfully!');

        return redirect()->route('announcement.index');
    }
}
