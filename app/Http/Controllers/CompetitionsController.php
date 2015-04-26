<?php namespace App\Http\Controllers;

use App\Competition;
use App\Http\Requests;
use App\Http\Controllers\ApiController;
use App\StatsFc\Transformers\CompetitionTransformer;

use Illuminate\Http\Request;

class CompetitionsController extends ApiController {

    /**
     * @var App\StatsFc\Transformers\CompetitionTransformer
     */
    protected $competitionTransformer;

    public function __construct(CompetitionTransformer $competitionTransformer)
    {
        $this->competitionTransformer = $competitionTransformer;
    }

    public function index(Request $request)
    {
        $competitions = Competition::select('competitionNew.*')->online();

        if ($request->has('region')) {
            $competitions = $competitions->join('region', 'competitionNew.region_id', '=', 'region.id')->where('region.name', $request->input('region'));
        }

        $competitions = $competitions->get();

        return $this->respond([
            'data' => $this->competitionTransformer->transformCollection($competitions->all())
        ]);

        /*$competitions = Competition::select('competitionNew.id', 'competitionNew.name', 'region.name AS region')
            ->online()
            ->leftJoin('region', 'competitionNew.region_id', '=', 'region.id')
            ->orderBy('competitionNew.name')
            ->get();

        return response($competitions->toJson())->header('Content-Type', 'application/json');*/
    }

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
