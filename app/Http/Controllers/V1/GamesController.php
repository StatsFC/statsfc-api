<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Transformers\V1\GameTransformer;

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
