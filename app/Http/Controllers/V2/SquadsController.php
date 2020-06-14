<?php
namespace App\Http\Controllers\V2;

use App\Http\Controllers\ApiController;
use App\Transformers\V2\SquadTransformer;
use App\Models\V2\Team;
use Illuminate\Http\Request;

class SquadsController extends ApiController
{
    protected $squadTransformer;

    public function __construct(SquadTransformer $squadTransformer)
    {
        $this->squadTransformer = $squadTransformer;
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

        $squads = Team::select('teams.*')
            ->distinct()
            ->visibleByCustomer($request->session()->get('customer_id'))
            ->filterSeason($request)
            ->filterCompetition($request)
            ->filterTeam($request)
            ->groupBy('teams.id')
            ->orderBy('teams.name')
            ->get();

        return $this->respond([
            'data' => $this->squadTransformer->transformCollection($squads->all()),
        ]);
    }
}
