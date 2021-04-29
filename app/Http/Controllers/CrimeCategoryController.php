<?php

namespace App\Http\Controllers;

use App\Models\CrimeCategory;
use Illuminate\Http\Request;
use App\Models\Incident;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CrimeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CrimeCategory::all();

        return view('pages.admin.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.create');
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
        $r = request();

        // Validate request
        $this->validate($r, [
            'category_name' => 'required',
        ]);


        // Store request
        $category = CrimeCategory::create([
            'category_name' => $r->category_name,

        ]);

        // flash message to session
        Session::flash('success', 'Crime Category created successfully!');

        // Redirect on success
        return redirect()->route('crime-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CrimeCategory  $crimeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CrimeCategory $crimeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CrimeCategory  $crimeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CrimeCategory::findOrFail($id);

        return view('pages.admin.category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CrimeCategory  $crimeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = CrimeCategory::findOrFail($id);

        $category->category_name = $request->category_name;

        $category->save();

        Session::flash('success', 'Crime category updated successfully!');

        return redirect()->route('crime-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CrimeCategory  $crimeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = CrimeCategory::findOrFail($id);

        foreach ($category->incidents as $incident) {
            $incident->forceDelete();
        }

        $category->delete();

        // flash message to session
        Session::flash('success', 'Category deleted successfully!');

        // Redirect on success
        return redirect()->route('crime-category.index');
    }
}
