<?php
namespace App\Http\Controllers;

use App\Models\State;
use App\Transformers\StateTransformer;
use Illuminate\Http\Request;

class StatesController extends ApiController
{
    /**
     * @var StateTransformer
     */
    protected $stateTransformer;

    /**
     * Set the state transformer
     *
     * @param StateTransformer $stateTransformer
     */
    public function __construct(StateTransformer $stateTransformer)
    {
        $this->stateTransformer = $stateTransformer;
    }

    /**
     * Output a list of states
     *
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->respond([
            'data' => $this->stateTransformer->transformCollection(State::get()->all()),
        ]);
    }
}
