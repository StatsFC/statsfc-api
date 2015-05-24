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
        $customer_id = $request->session()->get('customer_id');

        $games = Game::select('games.*')
            ->visibleByCustomer($customer_id)
            ->filterSeason($request)
            ->filterCompetition($request)
            ->filterTeam($request)
            ->hasEnded()
            ->orderBy('games.timestamp')
            ->orderBy('games.id');

        /**
         * @todo Pass $request and $games to the parent class, to handle filters and response
         */

        return $this->respond([
            'data' => $this->gameTransformer->transformCollection($games->get()->all())
        ]);
    }
}