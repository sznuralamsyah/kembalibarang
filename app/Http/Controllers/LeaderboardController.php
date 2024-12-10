<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $users = User::query()->withCount(['resolvedCases' => function ($q) {
            $q->whereHas('item', fn($i) => $i->where('type', 'lost'))->where('status', 1);
        }])->orderBy('resolved_cases_count', 'desc')->limit(10)->get();
        return view('leaderboard', ['users' => $users]);
    }
}
