<?php

namespace App\Http\Controllers;

use App\Models\Submission;

class ExhibitionController extends Controller
{
    public function index()
    {
        $submissions = Submission::where('is_finalist', 1)
                        ->orderBy('score', 'desc')
                        ->take(10)
                        ->get();

        return view('exhibition', compact('submissions'));
    }

    public function getTeamMembersAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

}
