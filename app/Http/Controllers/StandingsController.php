<?php
namespace App\Http\Controllers;

use App\Models\Standing;
use App\Transformers\StandingTransformer;
use Illuminate\Http\Request;

class StandingsController extends ApiController
{
    protected $standingTransformer;

    public function __construct(StandingTransformer $standingTransformer)
    {
        $this->standingTransformer = $standingTransformer;
    }

    public function index(Request $request)
    {
        $standings = Standing::select('standings.*')
            ->visibleByCustomer($request->session()->get('customer_id'))
            ->filterSeason($request)
            ->filterCompetition($request)
            ->groupBy([
                'standings.competition_id',
                'standings.season_id',
                'standings.team_id',
            ])
            ->orderBy('competitions.order')
            ->orderBy('standings.position')
            ->get();

        return $this->respond([
            'data' => $this->standingTransformer->transformCollection($standings->all()),
        ]);
    }
}
