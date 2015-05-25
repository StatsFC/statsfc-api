<?php
namespace App\Http\Controllers;

use App\TopScorer;
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

        $topScorers = TopScorer::get($request);

        return $this->respond([
            'data' => $this->topScorerTransformer->transformCollection($topScorers)
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
