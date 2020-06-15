<?php
namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    const TYPE_GOAL               = 'goal';
    const TYPE_MISSED_PENALTY     = 'pen miss';
    const TYPE_RED_CARD           = 'redcard';
    const TYPE_SECOND_YELLOW_CARD = 'yellowred';
    const TYPE_SUBSTITUTION       = 'subst';
    const TYPE_YELLOW_CARD        = 'yellowcard';

    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'match_id'     => 'integer',
        'team_id'      => 'integer',
        'player_id'    => 'integer',
        'assist_id'    => 'integer',
        'type'         => 'string',
        'minute'       => 'integer',
        'extra_minute' => 'integer',
        'penalty'      => 'boolean',
        'own_goal'     => 'boolean',
        'home_score'   => 'integer',
        'away_score'   => 'integer',
    ];

    public function matchTime()
    {
        return $this->minute . ($this->extra_minute ? '+' . $this->extra_minute : '') . "'";
    }

    public function subType()
    {
        switch ($this->type) {
            case self::TYPE_GOAL:
                if ($this->penalty) {
                    return 'penalty';
                }

                if ($this->own_goal) {
                    return 'own-goal';
                }

                break;

            case self::TYPE_YELLOW_CARD:
                return 'first-yellow';

            case self::TYPE_SECOND_YELLOW_CARD:
                return 'second-yellow';

            case self::TYPE_RED_CARD:
                return 'red';
        }

        return null;
    }

    /**
     * Define the relationship to a match
     *
     * @return BelongsTo
     */
    public function match()
    {
        return $this->belongsTo('App\Models\Match');
    }

    /**
     * Define the relationship to a team
     *
     * @return BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    /**
     * Define the relationship to a player
     *
     * @return BelongsTo
     */
    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }

    /**
     * Define the relationship to an assist
     *
     * @return BelongsTo
     */
    public function assist()
    {
        return $this->belongsTo('App\Models\Player');
    }

    public static function topScorers()
    {
        $instance = new static;

        return $instance->newQuery()
            ->select([
                'players.id',
                'players.name AS playerName',
                'teams.name AS teamName',
                'teams.short_name AS teamShortName',
                DB::raw('COUNT(events.id) AS goals'),
            ])
            ->join('players', 'events.player_id', '=', 'players.id')
            ->join('teams', 'events.team_id', '=', 'teams.id')
            ->join('matches', 'events.match_id', '=', 'matches.id')
            ->where('events.type', '=', 'goal')
            ->where('events.own_goal', '=', false)
            ->groupBy('players.id')
            ->orderBy('goals', 'desc')
            ->orderBy('players.name', 'asc');
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
            ->join('competitions', 'matches.competition_id', '=', 'competitions.id')
            ->where('competitions.enabled', true)
            ->join('competition_payment', 'competitions.id', '=', 'competition_payment.competition_id')
            ->join('payments', 'payments.id', '=', 'competition_payment.payment_id')
            ->whereRaw('? BETWEEN `payments`.`from` AND `payments`.`to`', [
                Carbon::today()->toDateString(),
            ])
            ->where('payments.customer_id', $customer_id);
    }

    /**
     * Define a scope to filter matches by team
     *
     * @param  Builder $query
     * @param  Request $request
     * @return Builder
     */
    public function scopeFilterTeam($query, $request)
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
     * Define a scope to filter matches by season
     *
     * @param  Builder $query
     * @param  Request $request
     * @return Builder
     */
    public function scopeFilterSeason($query, $request)
    {
        $query->join('seasons', 'matches.season_id', '=', 'seasons.id');

        if ($request->has('season')) {
            return $query->where('seasons.name', $request->input('season'));
        }

        return $query;
    }

    /**
     * Define a scope to filter matches by competition
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
