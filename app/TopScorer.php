<?php
namespace App;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class TopScorer
{
    /**
     * Get an array of top scorers
     *
     * @param  Request  $request
     * @return Collection
     */
    public static function get(Request $request)
    {
        $customer_id = $request->session()->get('customer_id');

        $query = DB::table('events')
            ->select([
                'players.id',
                'players.name AS playerName',
                'players.shortName AS playerShortName',
                'teams.name AS teamName',
                'teams.shortName AS teamShortName',
                DB::raw('COUNT(events.id) AS goals')
            ])
            ->join('players', 'events.player_id', '=', 'players.id')
            ->join('teams', 'events.team_id', '=', 'teams.id')
            ->join('games', 'events.game_id', '=', 'games.id')
            ->where('events.type', 'goal')
            ->whereRaw('IFNULL(events.subType, "") != "own-goal"')
            ->groupBy('players.id')
            ->orderBy('goals', 'desc')
            ->orderBy('players.shortName', 'asc');

        $query = static::visibleByCustomer($query, $customer_id);

        $query = static::filterSeason($query, $request);

        $query = static::filterCompetition($query, $request);

        $query = static::filterTeam($query, $request);

        return $query->get();
    }

    /**
     * Define a scope to filter competitions visible to a customer
     *
     * @param  Builder $query
     * @param  integer $customer_id
     * @return Builder
     */
    private static function visibleByCustomer($query, $customer_id)
    {
        return $query
            ->join('rounds', 'games.round_id', '=', 'rounds.id')
            ->join('competitions', 'rounds.competition_id', '=', 'competitions.id')
            ->where('competitions.online', true)
            ->join('payment_competition', 'competitions.id', '=', 'payment_competition.competition_id')
            ->join('payment', 'payment.id', '=', 'payment_competition.payment_id')
            ->whereRaw('? BETWEEN `payment`.`from` AND `payment`.`to`', [
                Carbon::today()->toDateString()
            ])
            ->where('payment.customer_id', $customer_id);
    }

    /**
     * Define a scope to filter games by team
     *
     * @param  Builder $query
     * @return Builder
     */
    private static function filterTeam($query, $request)
    {
        if ($request->has('team_id')) {
            return $query->where('events.team_id', $request->input('team_id'));
        }

        if ($request->has('team')) {
            return $query->where('teams.name', $request->input('team'));
        }

        return $query;
    }

    /**
     * Define a scope to filter games by season
     *
     * @param  Builder $query
     * @param  Request $request
     * @return Builder
     */
    private static function filterSeason($query, $request)
    {
        $query->join('seasons', 'rounds.season_id', '=', 'seasons.id');

        if ($request->has('season')) {
            return $query->where('seasons.name', $request->input('season'));
        }

        // By default, show games for the current season only
        return $query->whereRaw('? BETWEEN `seasons`.`start` AND `seasons`.`end`', [
            Carbon::today()->toDateString()
        ]);
    }

    /**
     * Define a scope to filter games by competition
     *
     * @param  Builder $query
     * @param  Request $request
     * @return Builder
     */
    private static function filterCompetition($query, $request)
    {
        if ($request->has('competition')) {
            return $query->where('competitions.name', $request->input('competition'));
        }

        if ($request->has('competition_id')) {
            return $query->where('competitions.id', $request->input('competition_id'));
        }

        if ($request->has('competition_key')) {
            return $query->where('competitions.key', $request->input('competition_key'));
        }

        return $query;
    }
}
