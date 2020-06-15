<?php
namespace App\Models;

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
        'id'   => 'integer',
        'name' => 'string',
    ];

    /**
     * Define the relationship to it's events
     *
     * @return HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }

    /**
     * Define the relationship to it's players
     *
     * @return HasMany
     */
    public function players()
    {
        return $this->hasMany('App\Models\Player');
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
            ->join('matches', function ($join) {
                $join->on('teams.id', '=', 'matches.home_id')->orOn('teams.id', '=', 'matches.away_id');
            })
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
            return $query->where('teams.id', $request->input('team_id'));
        }

        if ($request->has('team')) {
            return $query->where('teams.name', $request->input('team'));
        }

        return $query;
    }
}
