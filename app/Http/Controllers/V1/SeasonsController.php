<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Season;
use App\Transformers\V1\SeasonTransformer;
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
            ->groupBy('seasons.id')
            ->orderBy('seasons.start')
            ->get();

        return $this->respond([
            'data' => $this->seasonTransformer->transformCollection($seasons->all()),
        ]);
    }
}
