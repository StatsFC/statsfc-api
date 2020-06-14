<?php
namespace App\Http\Controllers;

use App\Models\Season;
use App\Transformers\SeasonTransformer;
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
