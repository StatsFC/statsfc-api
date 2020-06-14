<?php
namespace App\Http\Controllers\V2;

use App\Http\Controllers\ApiController;
use App\Models\V2\Event;
use App\Transformers\V2\TopScorerTransformer;
use Illuminate\Http\Request;

class TopScorersController extends ApiController
{
    protected $topScorerTransformer;

    public function __construct(TopScorerTransformer $topScorerTransformer)
    {
        $this->topScorerTransformer = $topScorerTransformer;
    }

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

        $topScorers = Event::topScorers()
            ->visibleByCustomer($request->session()->get('customer_id'))
            ->filterTeam($request)
            ->filterSeason($request)
            ->filterCompetition($request)
            ->get();

        return $this->respond([
            'data' => $this->topScorerTransformer->transformCollection($topScorers->all()),
        ]);
    }
}
