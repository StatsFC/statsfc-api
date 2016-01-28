<?php
namespace App\Http\Controllers;

use App\Team;
use App\Http\Requests;
use App\Transformers\SquadTransformer;
use Illuminate\Http\Request;

class SquadsController extends ApiController
{
    /**
     * @var SquadTransformer
     */
    protected $squadTransformer;

    /**
     * Set the squad transformer
     *
     * @param SquadTransformer $squadTransformer
     */
    public function __construct(SquadTransformer $squadTransformer)
    {
        $this->squadTransformer = $squadTransformer;
    }

    /**
     * Output a list of squads
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
            'team'
        ];

        if (! $this->hasRequiredFilter($request, $required)) {
            return $this->respondUnauthorised('You must filter by competition or team');
        }

        $customer_id = $request->session()->get('customer_id');

        $squads = Team::select('teams.*')
            ->distinct()
            ->visibleByCustomer($customer_id)
            ->filterSeason($request)
            ->filterCompetition($request)
            ->filterTeam($request)
            ->groupBy('teams.id')
            ->orderBy('teams.name')
            ->get();

        return $this->respond([
            'data' => $this->squadTransformer->transformCollection($squads->all())
        ]);
    }
}
