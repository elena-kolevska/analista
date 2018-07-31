<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackedTermsController extends Controller
{
    public function create()
    {
        return view('add_term');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tracked_term' => 'required|max:30'
        ]);

        app()->make('App\TrackedTerm')->store($request->get('tracked_term'));

        return redirect('dashboard');
    }
}
