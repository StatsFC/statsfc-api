<?php
namespace App\Http\Controllers;

use App\Transformers\MatchTransformer;

class MatchesController extends ApiController
{
    protected $matchTransformer;

    public function __construct(MatchTransformer $matchTransformer)
    {
        $this->matchTransformer = $matchTransformer;
    }
}
