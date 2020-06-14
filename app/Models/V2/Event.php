<?php
namespace App\Models\V2;

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

    public static function topScorers()
    {
        return (new static)->newQuery()
            ->select([
                'players.id',
                'players.name AS playerName',
                'teams.name AS teamName',
                'teams.short_name AS teamShortName',
                DB::raw('COUNT(events.id) AS goals'),
            ])
            ->join('players', 'players.id', '=', 'events.player_id')
            ->join('teams', 'teams.id', '=', 'events.team_id')
            ->join('matches', 'matches.id', '=', 'events.match_id')
            ->where('events.type', '=', static::TYPE_GOAL)
            ->where('events.own_goal', '=', false)
            ->groupBy('players.id')
            ->orderBy('goals', 'desc')
            ->orderBy('players.short_name', 'asc');
    }

    public function assist()
    {
        return $this->belongsTo('App\Models\V2\Player', 'assist_id');
    }

    public function match()
    {
        return $this->belongsTo('App\Models\V2\Match');
    }

    public function player()
    {
        return $this->belongsTo('App\Models\V2\Player');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\V2\Team');
    }

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

    public function scopeFilterSeason($query, $request)
    {
        $query->join('seasons', 'seasons.id', '=', 'matches.season_id');

        if ($request->has('season')) {
            return $query->where('seasons.name', $request->input('season'));
        }

        return $query;
    }

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

    public function scopeVisibleByCustomer($query, $customer_id)
    {
        return $query
            ->join('competitions', 'competitions.id', '=', 'matches.competition_id')
            ->join('competition_payment', 'competition_payment.competition_id', '=', 'competitions.id')
            ->join('payments', 'payments.id', '=', 'competition_payment.payment_id')
            ->where('competitions.enabled', true)
            ->whereRaw('? BETWEEN `payments`.`from` AND `payments`.`to`', [
                Carbon::today()->toDateString(),
            ])
            ->where('payments.customer_id', $customer_id);
    }
}
