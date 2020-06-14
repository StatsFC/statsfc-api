<?php
namespace App\Http\Controllers;

use App\Transformers\GameTransformer;

class GamesController extends ApiController
{
    /**
     * @var GameTransformer
     */
    protected $gameTransformer;

    /**
     * Set the game transformer
     *
     * @param GameTransformer $gameTransformer
     */
    public function __construct(GameTransformer $gameTransformer)
    {
        $this->gameTransformer = $gameTransformer;
    }
}
