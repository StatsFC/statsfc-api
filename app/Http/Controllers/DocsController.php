<?php
namespace App\Http\Controllers;

class DocsController extends Controller
{
    public function index()
    {
        $sections = [
            'rate-limits'    => 'Rate Limits',
            'authentication' => 'Authentication',
            'competitions'   => 'Competitions',
            'seasons'        => 'Seasons',
            'fixtures'       => 'Fixtures',
            'results'        => 'Results',
            'standings'      => 'Standings',
            'top-scorers'    => 'Top Scorers',
            'squads'         => 'Squads',
            'errors'         => 'Errors',
            'faqs'           => 'FAQs',
            'coverage'       => 'Competition Coverage',
        ];

        return view('docs', [
            'sections' => $sections,
        ]);
    }
}
