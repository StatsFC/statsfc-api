<?php
namespace App\Http\Controllers\V2;

use App\Http\Controllers\ApiController;
use App\Models\V2\Standing;
use App\Transformers\V2\StandingTransformer;
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
