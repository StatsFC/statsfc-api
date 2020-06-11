<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Models\V1\Competition;
use App\Transformers\V1\CompetitionTransformer;
use Illuminate\Http\Request;

class CompetitionsController extends ApiController
{
    /**
     * @var CompetitionTransformer
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

        $competitions = Competition::select('competitions.*')
            ->visibleByCustomer($customer_id)
            ->filterRegion($request)
            ->groupBy('competitions.id')
            ->get();

        return $this->respond([
            'data' => $this->competitionTransformer->transformCollection($competitions->all()),
        ]);
    }
}
