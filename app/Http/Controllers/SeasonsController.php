<?php
namespace App\Http\Controllers;

use App\Season;
use App\Http\Requests;
use App\Transformers\SeasonTransformer;
use Illuminate\Http\Request;

class SeasonsController extends ApiController
{
    /**
     * @var SeasonTransformer
     */
    protected $seasonTransformer;

    /**
     * Set the season transformer
     *
     * @param SeasonTransformer $seasonTransformer
     */
    public function __construct(SeasonTransformer $seasonTransformer)
    {
        $this->seasonTransformer = $seasonTransformer;
    }

    /**
     * Output a list of seasons
     *
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $customer_id = $request->session()->get('customer_id');

        $seasons = Season::select('seasons.*')
            ->distinct()
            ->visibleByCustomer($customer_id)
            ->orderBy('seasons.start')
            ->get();

        return $this->respond([
            'data' => $this->seasonTransformer->transformCollection($seasons->all())
        ]);
    }

    /**
     * Output details for a single season
     *
     * @param  integer $id
     * @return mixed
     */
    public function show($id)
    {
        $season = Season::find($id);

        if (! $season) {
            return $this->respondNotFound('Season not found');
        }

        return $this->respond([
            'data' => $this->seasonTransformer->transform($season)
        ]);
    }
}
