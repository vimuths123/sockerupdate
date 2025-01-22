<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $finishedGames = Game::with(['teamA', 'teamB', 'winnerTeam'])
            ->where('status', 'Finished')
            ->latest('created_at') // Order by latest based on the `created_at` column
            ->get();

        $liveGames = Game::with(['teamA', 'teamB'])
            ->where('status', 'In Progress')
            ->latest('created_at') // Order by latest based on the `created_at` column
            ->get();

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'finishedGames' => $finishedGames,
            'liveGames' => $liveGames
        ]);
    }
}
