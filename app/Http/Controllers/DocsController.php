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
            'states'         => 'States',
            'fixtures'       => 'Fixtures',
            'results'        => 'Results',
            'standings'      => 'Standings',
            'top-scorers'    => 'Top Scorers',
            'squads'         => 'Squads',
            'errors'         => 'Errors',
            'faqs'           => 'FAQs'
        ];

        return view('docs', [
            'sections' => $sections
        ]);
    }
}
