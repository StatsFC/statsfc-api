<?php
namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $sections = [
            'competitions' => 'Competitions',
            'seasons'      => 'Seasons',
            'states'       => 'States',
            'fixtures'     => 'Fixtures',
            'results'      => 'Results',
            'standings'    => 'Standings',
            'top-scorers'  => 'Top Scorers',
        ];

        return view('home', [
            'sections' => $sections
        ]);
    }
}
