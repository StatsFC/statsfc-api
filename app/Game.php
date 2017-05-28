<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'round_id'  => 'integer',
        'home_id'   => 'integer',
        'away_id'   => 'integer',
        'state_id'  => 'integer',
        'homeGoals' => 'integer',
        'awayGoals' => 'integer',
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
            'updated_at'
        ];
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
    public function scopeFilterTeam($query, $request)
    {
        if ($request->has('team_id')) {
            return $query->whereRaw('? IN (games.`home_id`, games.`away_id`)', [
                $request->input('team_id')
            ]);
        }

        if ($request->has('team')) {
            return $query
                ->join('teams AS home', 'games.home_id', '=', 'home.id')
                ->join('teams AS away', 'games.away_id', '=', 'away.id')
                ->whereRaw('? IN (`home`.`name`, `away`.`name`)', [
                    $request->input('team')
                ]);
        }
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
        if ($request->has('season_id')) {
            return $query->where('rounds.season_id', '=', $request->input('season_id'));
        }

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
    }

    /**
     * Define a scope to filter games by from/to dates
     *
     * @param  Builder $query
     * @param  Request $request
     * @return Builder
     */
    public function scopeFilterDates($query, $request)
    {
        if ($request->has('from')) {
            $query->whereRaw('DATE(`games`.`timestamp`) >= ?', [
                $request->input('from')
            ]);
        }

        if ($request->has('to')) {
            $query->whereRaw('DATE(`games`.`timestamp`) <= ?', [
                $request->input('to')
            ]);
        }

        return $query;
    }

    /**
     * Define a scope to filter games that have ended
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeHasEnded($query)
    {
        return $query
            ->join('states', 'games.state_id', '=', 'states.id')
            ->where('states.ended', true)
            ->whereRaw('DATE(`games`.`timestamp`) <= ?', [
                Carbon::today()->toDateString()
            ]);
    }

    /**
     * Define a scope to filter games that have not ended
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeHasNotEnded($query)
    {
        return $query
            ->join('states', 'games.state_id', '=', 'states.id')
            ->where('states.ended', false)
            ->whereRaw('DATE(`games`.`timestamp`) >= ?', [
                Carbon::today()->toDateString()
            ]);
    }

    /**
     * Define the relationship to a round
     *
     * @return BelongsTo
     */
    public function round()
    {
        return $this->belongsTo('App\Round');
    }

    /**
     * Define the relationship to a home team
     *
     * @return BelongsTo
     */
    public function home()
    {
        return $this->belongsTo('App\Team', 'home_id');
    }

    /**
     * Define the relationship to a away team
     *
     * @return BelongsTo
     */
    public function away()
    {
        return $this->belongsTo('App\Team', 'away_id');
    }

    /**
     * Define the relationship to a venue
     *
     * @return BelongsTo
     */
    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

    /**
     * Define the relationship to a state
     *
     * @return BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
     * Define the relationship to it's cards
     *
     * @return HasMany
     */
    public function cards()
    {
        return $this->hasMany('App\Card');
    }

    /**
     * Define the relationship to it's goals
     *
     * @return HasMany
     */
    public function goals()
    {
        return $this->hasMany('App\Goal');
    }

    /**
     * Define the relationship to it's game states
     *
     * @return HasMany
     */
    public function gameStates()
    {
        return $this->hasMany('App\GameState');
    }

    /**
     * Define the relationship to it's substitutions
     *
     * @return HasMany
     */
    public function substitutions()
    {
        return $this->hasMany('App\Substitution');
    }

    /**
     * Define the relationship to it's players
     *
     * @return HasMany
     */
    public function players()
    {
        return $this->hasMany('App\GamePlayer');
    }

    /**
     * Return whether or not the match has ended
     *
     * @return boolean
     */
    public function hasEnded()
    {
        return $this->state->ended;
    }
}
