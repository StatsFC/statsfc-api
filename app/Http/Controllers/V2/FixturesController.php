<?php
namespace App\Http\Controllers\V2;

use App\Models\V2\Match;
use Illuminate\Http\Request;

class FixturesController extends MatchesController
{
    public function index(Request $request)
    {
        $matches = Match::select('matches.*')
            ->visibleByCustomer($request->session()->get('customer_id'))
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
