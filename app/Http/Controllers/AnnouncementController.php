<?php

namespace App\Http\Controllers;

use App\Models\Submission;

class AnnouncementController extends Controller
{
    public function index()
    {
        $submissions = Submission::where('is_finalist', 1)
                        ->whereIn('rank', [1, 2, 3, 4, 5])
                        ->orderBy('score', 'desc')
                        ->take(10)
                        ->get();

        return view('announcement', compact('submissions'));
    }

    public function getTeamMembersAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function showFinalists()
    {
        $submissions = Submission::where('is_finalist', 1)
                                ->orderBy('score', 'desc')
                                ->take(10)
                                ->get();

        return view('finalists', compact('submissions'));
    }
    public function showVoting()
    {
        // Ambil Top 5 submissions yang is_finalist = 1 dan rank = 1 berdasarkan skor
        $submissions = Submission::where('is_finalist', 1)
                                ->whereIn('rank', [1, 2, 3, 4, 5])
                                ->orderBy('score', 'desc')
                                ->take(5)
                                ->get();

        return view('voting', compact('submissions'));
    }


}
