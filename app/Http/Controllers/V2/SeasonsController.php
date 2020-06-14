<?php
namespace App\Http\Controllers\V2;

use App\Http\Controllers\ApiController;
use App\Models\V2\Season;
use App\Transformers\V2\SeasonTransformer;
use Illuminate\Http\Request;

class SeasonsController extends ApiController
{
    protected $seasonTransformer;

    public function __construct(SeasonTransformer $seasonTransformer)
    {
        $this->seasonTransformer = $seasonTransformer;
    }

    public function index(Request $request)
    {
        $seasons = Season::select('seasons.*')
            ->distinct()
            ->visibleByCustomer($request->session()->get('customer_id'))
            ->groupBy('seasons.id')
            ->orderBy('seasons.name')
            ->get();

        return $this->respond([
            'data' => $this->seasonTransformer->transformCollection($seasons->all()),
        ]);
    }
}
