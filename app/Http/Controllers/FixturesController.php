<?php
namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests;
use App\Http\Controllers\GamesController;

use Illuminate\Http\Request;

class FixturesController extends GamesController
{
    /**
     * Output a list of competitions
     *
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $games = Game::select('games.*')
            ->join('states', 'games.state_id', '=', 'states.code')
            ->where('states.ended', false)
            ->whereRaw('DATE(`games`.`timestamp`) >= CURDATE()')
            ->get();

        return $this->respond([
            'data' => $this->gameTransformer->transformCollection($games->all())
        ]);
    }
}
