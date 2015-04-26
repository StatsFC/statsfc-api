<?php
namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests;
use App\Http\Controllers\ApiController;
use App\Transformers\GameTransformer;

use Illuminate\Http\Request;

class GamesController extends ApiController
{
    /**
     * @var App\Transformers\GameTransformer
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

    /**
     * Output details for a single game
     *
     * @param  integer $id
     * @return mixed
     */
    public function show($id)
    {
        $game = Game::find($id);

        if (! $game) {
            return $this->respondNotFound('Game not found');
        }

        return $this->respond([
            'data' => $this->gameTransformer->transform($game)
        ]);
    }
}
