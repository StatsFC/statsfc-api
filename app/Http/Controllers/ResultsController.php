<?php
namespace App\Http\Controllers;

use App\Models\Match;
use Illuminate\Http\Request;

class ResultsController extends MatchesController
{
    public function index(Request $request)
    {
        $matches = Match::select('matches.*')
            ->visibleByCustomer($request->session()->get('customer_id'))
            ->filterSeason($request)
            ->filterCompetition($request)
            ->filterTeam($request)
            ->filterDates($request)
            ->hasEnded()
            ->groupBy('matches.id')
            ->orderBy('matches.start')
            ->orderBy('matches.id')
            ->get();

        return $this->respond([
            'data' => $this->matchTransformer->transformCollection($matches->all()),
        ]);
    }
}
