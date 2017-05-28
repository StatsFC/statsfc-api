<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'       => 'integer',
        'venue_id' => 'integer',
        'national' => 'boolean',
    ];

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
        return $this->hasMany('App\Player');
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
            ->join('games', function ($join) {
                $join->on('teams.id', '=', 'games.home_id')->orOn('teams.id', '=', 'games.away_id');
            })
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
            return $query->where('teams.id', $request->input('team_id'));
        }

        if ($request->has('team')) {
            return $query->where('teams.name', $request->input('team'));
        }

        return $query;
    }
}
