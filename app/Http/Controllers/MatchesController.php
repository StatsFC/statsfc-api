<?php
namespace App\Http\Controllers;

use App\Transformers\MatchTransformer;

class MatchesController extends ApiController
{
    /**
     * @var MatchTransformer
     */
    protected $matchTransformer;

    /**
     * Set the game transformer
     *
     * @param MatchTransformer $matchTransformer
     */
    public function __construct(MatchTransformer $matchTransformer)
    {
        $this->matchTransformer = $matchTransformer;
    }
}
