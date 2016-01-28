<?php
namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests;
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
            ->filterDates($request)
            ->hasNotEnded()
            ->groupBy('games.id')
            ->orderBy('games.timestamp')
            ->orderBy('games.id')
            ->get();

        return $this->respond([
            'data' => $this->gameTransformer->transformCollection($games->all())
        ]);
    }
}
