<?php
namespace App\Http\Controllers\V2;

use App\Http\Controllers\ApiController;
use App\Models\V2\Competition;
use App\Transformers\V2\CompetitionTransformer;
use Illuminate\Http\Request;

class CompetitionsController extends ApiController
{
    protected $competitionTransformer;

    public function __construct(CompetitionTransformer $competitionTransformer)
    {
        $this->competitionTransformer = $competitionTransformer;
    }

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
