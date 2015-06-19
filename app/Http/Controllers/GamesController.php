<?php
namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests;
use App\Transformers\GameTransformer;
use Illuminate\Http\Request;

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
