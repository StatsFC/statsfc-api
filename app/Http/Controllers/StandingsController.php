<?php
namespace App\Http\Controllers;

use App\Models\Standing;
use App\Transformers\StandingTransformer;
use Illuminate\Http\Request;

class StandingsController extends ApiController
{
    /**
     * @var StandingTransformer
     */
    protected $standingTransformer;

    /**
     * Set the standing transformer
     *
     * @param StandingTransformer $standingTransformer
     */
    public function __construct(StandingTransformer $standingTransformer)
    {
        $this->standingTransformer = $standingTransformer;
    }

    /**
     * Output a list of standings
     *
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $customer_id = $request->session()->get('customer_id');

        $standings = Standing::select('standings.*')
            ->visibleByCustomer($customer_id)
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
