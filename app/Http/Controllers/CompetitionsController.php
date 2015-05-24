<?php
namespace App\Http\Controllers;

use App\Competition;
use App\Http\Requests;
use App\Http\Controllers\ApiController;
use App\Transformers\CompetitionTransformer;

use Illuminate\Http\Request;

class CompetitionsController extends ApiController
{
    /**
     * @var App\Transformers\CompetitionTransformer
     */
    protected $competitionTransformer;

    /**
     * Set the competition transformer
     *
     * @param CompetitionTransformer $competitionTransformer
     */
    public function __construct(CompetitionTransformer $competitionTransformer)
    {
        $this->competitionTransformer = $competitionTransformer;
    }

    /**
     * Output a list of competitions
     *
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $customer_id = $request->session()->get('customer_id');

        $competitions = Competition::select('competitions.*')->visibleByCustomer($customer_id);

        if ($request->has('region')) {
            $competitions
                ->join('region', 'competitions.region_id', '=', 'region.id')
                ->where('region.name', $request->input('region'));
        }

        return $this->respond([
            'data' => $this->competitionTransformer->transformCollection($competitions->get()->all())
        ]);
    }

    /**
     * Output details for a single competition
     *
     * @param  integer $id
     * @return mixed
     */
    public function show($id)
    {
        $competition = Competition::find($id);

        if (! $competition) {
            return $this->respondNotFound('Competition not found');
        }

        return $this->respond([
            'data' => $this->competitionTransformer->transform($competition)
        ]);
    }
}
