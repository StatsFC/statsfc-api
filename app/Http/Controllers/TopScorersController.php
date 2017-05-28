<?php
namespace App\Http\Controllers;

use App\Goal;
use App\Transformers\TopScorerTransformer;
use Illuminate\Http\Request;

class TopScorersController extends ApiController
{
    /**
     * @var TopScorerTransformer
     */
    protected $topScorerTransformer;

    /**
     * Set the top scorer transformer
     *
     * @param TopScorerTransformer $topScorerTransformer
     */
    public function __construct(TopScorerTransformer $topScorerTransformer)
    {
        $this->topScorerTransformer = $topScorerTransformer;
    }

    /**
     * Output a list of top scorers
     *
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $required = [
            'competition_id',
            'competition_key',
            'competition',
            'team_id',
            'team',
        ];

        if (! $this->hasRequiredFilter($request, $required)) {
            return $this->respondUnauthorised('You must filter by competition or team');
        }

        $customer_id = $request->session()->get('customer_id');

        $topScorers = Goal::topScorers()
            ->visibleByCustomer($customer_id)
            ->filterTeam($request)
            ->filterSeason($request)
            ->filterCompetition($request)
            ->get();

        return $this->respond([
            'data' => $this->topScorerTransformer->transformCollection($topScorers->all()),
        ]);
    }
}
