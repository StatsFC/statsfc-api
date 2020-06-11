<?php
namespace App\Models\V1;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'game_id'    => 'integer',
        'team_id'    => 'integer',
        'player_id'  => 'integer',
        'assist_id'  => 'integer',
        'homeGoals'  => 'integer',
        'awayGoals'  => 'integer',
    ];

    /**
     * Define fields to be treated as Carbon dates
     *
     * @return array
     */
    public function getDates()
    {
        return [
            'timestamp',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Define the relationship to a game
     *
     * @return BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('App\Models\V1\Game');
    }

    /**
     * Define the relationship to a team
     *
     * @return BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Models\V1\Team');
    }

    /**
     * Define the relationship to a player
     *
     * @return BelongsTo
     */
    public function player()
    {
        return $this->belongsTo('App\Models\V1\Player');
    }

    /**
     * Define the relationship to an assist
     *
     * @return BelongsTo
     */
    public function assist()
    {
        return $this->belongsTo('App\Models\V1\Player');
    }

    public static function topScorers()
    {
        $instance = new static;

        return $instance->newQuery()
            ->select([
                'players.id',
                'players.name AS playerName',
                'players.shortName AS playerShortName',
                'teams.name AS teamName',
                'teams.shortName AS teamShortName',
                DB::raw('COUNT(goals.id) AS goals'),
            ])
            ->join('players', 'goals.player_id', '=', 'players.id')
            ->join('teams', 'goals.team_id', '=', 'teams.id')
            ->join('games', 'goals.game_id', '=', 'games.id')
            ->whereRaw('IFNULL(goals.subType, "") != "own-goal"')
            ->groupBy('players.id')
            ->orderBy('goals', 'desc')
            ->orderBy('players.shortName', 'asc');
    }

    /**
     * Define a scope to filter competitions visible to a customer
     *
     * @param  Builder $query
     * @param  integer $customer_id
     * @return Builder
     */
    public function scopeVisibleByCustomer($query, $customer_id)
    {
        return $query
            ->join('rounds', 'games.round_id', '=', 'rounds.id')
            ->join('competitions', 'rounds.competition_id', '=', 'competitions.id')
            ->where('competitions.online', true)
            ->join('payment_competition', 'competitions.id', '=', 'payment_competition.competition_id')
            ->join('payment', 'payment.id', '=', 'payment_competition.payment_id')
            ->whereRaw('? BETWEEN `payment`.`from` AND `payment`.`to`', [
                Carbon::today()->toDateString(),
            ])
            ->where('payment.customer_id', $customer_id);
    }

    /**
     * Define a scope to filter games by team
     *
     * @param  Builder $query
     * @param  Request $request
     * @return Builder
     */
    public function scopeFilterTeam($query, $request)
    {
        if ($request->has('team_id')) {
            return $query->where('goals.team_id', $request->input('team_id'));
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
    public function scopeFilterSeason($query, $request)
    {
        $query->join('seasons', 'rounds.season_id', '=', 'seasons.id');

        if ($request->has('season')) {
            return $query->where('seasons.name', $request->input('season'));
        }

        // By default, show games for the current season only
        return $query->whereRaw('? BETWEEN `seasons`.`start` AND `seasons`.`end`', [
            Carbon::today()->toDateString(),
        ]);
    }

    /**
     * Define a scope to filter games by competition
     *
     * @param  Builder $query
     * @param  Request $request
     * @return Builder
     */
    public function scopeFilterCompetition($query, $request)
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
