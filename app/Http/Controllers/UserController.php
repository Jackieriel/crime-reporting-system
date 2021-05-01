<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function users(Request $request)
    {
        if ($request->user()->is_super_admin() || $request->user()->is_security_agency()) {
            $users = User::orderBy('created_at', 'desc')->paginate(10);

            $title = 'Manage Users';

            return view('pages.admin.profile.users')
                ->with('users', $users)
                ->with('title', $title);
        } else {

            // flash message to session
            Session::flash('error', 'You have not sufficient permissions');

            return redirect('/')->withErrors('You have not sufficient permissions');
        }
    }

    public function destroy(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);

        if ($user && $request->user()->is_super_admin()) {

            // if (file_exists(public_path($incident->photo))) {
            //     unlink(public_path($incident->photo));
            // }

            User::destroy($id);

            Session::flash('success', 'Users deleted successfully!');
        } else {
            Session::flash('error', 'Invalid Operation. You have not sufficient permissions');
        }
        return redirect('home');
    }

    public function userRole($id)
    {
        $user = User::findOrFail($id);

        $title = 'Update User Role';

        return view('pages.admin.profile.role')
            ->with('user', $user)
            ->with('title', $title);
    }

    public function update(Request $request, $id)
    {
        // Validate data pass
        $this->validate($request, [
            'role' => 'required',

        ]);

        // find the post
        $role = User::findOrFail($id);

        $role->role = $request->role;


        // Save post
        $role->save();

        // Flash message
        Session::flash('success', 'User role updated successfully!');

        // redirect
        return redirect()->route('users');
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            // flash message to session
            Session::flash('info', 'requested page not found!');

            // Redirect on success
            return redirect()->route('users');
        }

        $title = 'User Profile';

        return view('pages.admin.profile.show')
            ->with('user', $user)
            ->with('title', $title);
    }
}
