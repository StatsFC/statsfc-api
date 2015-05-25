<?php
namespace App\Http\Controllers;

use App\State;
use App\Http\Requests;
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
            'data' => $this->stateTransformer->transformCollection(State::get()->all())
        ]);
    }

    /**
     * Output details for a single state
     *
     * @param  integer $id
     * @return mixed
     */
    public function show($id)
    {
        $state = State::find($id);

        if (! $state) {
            return $this->respondNotFound('State not found');
        }

        return $this->respond([
            'data' => $this->stateTransformer->transform($state)
        ]);
    }
}
