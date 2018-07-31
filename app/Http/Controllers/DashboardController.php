<?php

namespace App\Http\Controllers;

use App\TrackedTerm;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $trackedTerms = app()->make(TrackedTerm::class)->getAll();

        return view('dashboard')
            ->with('trackedTerms', $trackedTerms);
    }
}
