<?php
namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests;
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
        if (! $this->hasRequiredFilter($request)) {
            return $this->respondUnauthorised('You must filter by competition or team');
        }

        $customer_id = $request->session()->get('customer_id');

        $topScorers = Event::topScorers()
            ->visibleByCustomer($customer_id)
            ->filterTeam($request)
            ->filterSeason($request)
            ->filterCompetition($request)
            ->get();

        return $this->respond([
            'data' => $this->topScorerTransformer->transformCollection($topScorers->all())
        ]);
    }

    /**
     * Check if the request has a required filters
     *
     * @param  Request  $request
     * @return boolean
     */
    private function hasRequiredFilter(Request $request)
    {
        $filters = [
            'competition_id',
            'competition_key',
            'competition',
            'team_id',
            'team'
        ];

        foreach ($filters as $filter) {
            if ($request->has($filter)) {
                return true;
            }
        }

        return false;
    }
}
