<?php
namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests;
use App\Http\Controllers\GamesController;

use Illuminate\Http\Request;

class FixturesController extends GamesController
{
    /**
     * Output a list of games that haven't been played yet
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
            ->hasNotEnded()
            ->orderBy('games.timestamp', 'games.id');

        /**
         * @todo Pass $request and $games to the parent class, to handle filters and response
         */

        return $this->respond([
            'data' => $this->gameTransformer->transformCollection($games->get()->all())
        ]);
    }
}
