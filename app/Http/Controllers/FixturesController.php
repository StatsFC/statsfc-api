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
            ->join('teams AS home', 'games.home_id', '=', 'home.id')
            ->join('teams AS away', 'games.away_id', '=', 'away.id')
            ->where('states.ended', false)
            ->whereRaw('DATE(`games`.`timestamp`) >= CURDATE()')
            ->orderBy('games.timestamp')
            ->orderBy('home.name');

        if ($request->has('team')) {
            $games = $games->whereRaw('(home.name = ? OR away.name = ?)', [$request->input('team'), $request->input('team')]);
        }

        $games = $games->get();

        /**
         * @todo Pass $request and $games to the parent class, to handle filters and response
         */

        return $this->respond([
            'data' => $this->gameTransformer->transformCollection($games->all())
        ]);
    }
}
