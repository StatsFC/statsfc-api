<?php
namespace App\Http\Controllers\V2;

use App\Http\Controllers\ApiController;
use App\Transformers\V2\MatchTransformer;

class MatchesController extends ApiController
{
    protected $matchTransformer;

    public function __construct(MatchTransformer $matchTransformer)
    {
        $this->matchTransformer = $matchTransformer;
    }
}
