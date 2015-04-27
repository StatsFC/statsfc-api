<?php
namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests;
use App\Http\Controllers\GamesController;

use Illuminate\Http\Request;

class ResultsController extends GamesController
{
    /**
     * Output a list of games that have been played
     *
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $games = Game::select('games.*')
            ->join('rounds', 'games.round_id', '=', 'rounds.id')
            ->join('competitions', 'rounds.competition_id', '=', 'competitions.id')
            ->join('teams AS home', 'games.home_id', '=', 'home.id')
            ->join('teams AS away', 'games.away_id', '=', 'away.id')
            ->join('states', 'games.state_id', '=', 'states.code')
            ->where('states.ended', true)
            ->whereRaw('DATE(`games`.`timestamp`) <= CURDATE()')
            ->orderBy('games.timestamp')
            ->orderBy('home.name');

        if ($request->has('team')) {
            $games->whereRaw('? IN (home.`name`, away.`name`)', [$request->input('team')]);
        } elseif ($request->has('team_id')) {
            $games->whereRaw('? IN (home.`id`, away.`id`)', [$request->input('team_id')]);
        }

        if ($request->has('competition')) {
            $games->where('competitions.name', $request->input('competition'));
        } elseif ($request->has('competition_id')) {
            $games->where('competitions.id', $request->input('competition_id'));
        } elseif ($request->has('competition_key')) {
            $games->where('competitions.key', $request->input('competition_key'));
        }

        /**
         * @todo Pass $request and $games to the parent class, to handle filters and response
         */

        return $this->respond([
            'data' => $this->gameTransformer->transformCollection($games->get()->all())
        ]);
    }
}
