<?php
namespace App\Http\Controllers;

use App\Standing;
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

        $standings = Standing::select('tables.*')
            ->visibleByCustomer($customer_id)
            ->filterSeason($request)
            ->filterCompetition($request)
            ->groupBy([
                'tables.competition_id',
                'tables.round_id',
                'tables.team_id',
            ])
            ->orderBy('competitions.order')
            ->orderBy('tables.position')
            ->get();

        return $this->respond([
            'data' => $this->standingTransformer->transformCollection($standings->all()),
        ]);
    }
}
