<?php
namespace App\Http\Controllers;

class DocsController extends Controller
{
    public function index()
    {
        $sections = [
            'authentication' => 'Authentication',
            'competitions'   => 'Competitions',
            'seasons'        => 'Seasons',
            'states'         => 'States',
            'fixtures'       => 'Fixtures',
            'results'        => 'Results',
            'standings'      => 'Standings',
            'top-scorers'    => 'Top Scorers',
            'errors'         => 'Errors',
        ];

        return view('docs', [
            'sections' => $sections
        ]);
    }
}
