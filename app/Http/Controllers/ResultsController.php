<?php
namespace App\Http\Controllers;

use App\Models\Match;
use Illuminate\Http\Request;

class ResultsController extends MatchesController
{
    /**
     * Output a list of games that have been played
     *
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $customer_id = $request->session()->get('customer_id');

        $matches = Match::select('matches.*')
            ->visibleByCustomer($customer_id)
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
