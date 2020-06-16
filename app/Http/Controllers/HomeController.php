<?php
namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $sections = [
            'competitions' => 'Competitions',
            'seasons'      => 'Seasons',
            'fixtures'     => 'Fixtures',
            'results'      => 'Results',
            'standings'    => 'Standings',
            'top-scorers'  => 'Top Scorers',
            'squads'       => 'Squads',
        ];

        return view('home', [
            'sections' => $sections,
        ]);
    }
}
