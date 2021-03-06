<?php
namespace App\Http\Controllers;

use App\Models\Season;
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
            ->groupBy('seasons.id')
            ->orderBy('seasons.name')
            ->get();

        return $this->respond([
            'data' => $this->seasonTransformer->transformCollection($seasons->all()),
        ]);
    }
}
