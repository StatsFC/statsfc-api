<?php
namespace App\Http\Controllers;

use App\Models\Match;
use Illuminate\Http\Request;

class FixturesController extends MatchesController
{
    /**
     * Output a list of matches that haven't been played yet
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
            ->hasNotEnded()
            ->groupBy('matches.id')
            ->orderBy('matches.start')
            ->orderBy('matches.id')
            ->get();

        return $this->respond([
            'data' => $this->matchTransformer->transformCollection($matches->all()),
        ]);
    }
}
