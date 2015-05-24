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
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @param  int                                  $customer_id
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibleByCustomer($query, $customer_id)
    {
        return $query
            ->join('rounds', 'games.round_id', '=', 'rounds.id')
            ->join('competitions', 'rounds.competition_id', '=', 'competitions.id')
            ->join('payment_competition', 'competitions.id', '=', 'payment_competition.competition_id')
            ->join('payment', 'payment.id', '=', 'payment_competition.payment_id')
            ->whereRaw('? BETWEEN `payment`.`from` AND `payment`.`to`', [
                Carbon::today()->toDateString()
            ])
            ->where('payment.customer_id', $customer_id);
    }

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
                ->whereRaw('? IN (home.`name`, away.`name`)', [
                    $request->input('team')
                ]);
        }
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

        // By default, show games for the current season only
        return $query
            ->join('seasons', 'rounds.season_id', '=', 'seasons.id')
            ->whereRaw('? BETWEEN `season`.start` AND `seasons`.`end`', [
                Carbon::today()->toDateString()
            ])
    }

    public function scopeHasEnded($query)
    {
        return $query
            ->join('states', 'games.state_id', '=', 'states.code')
            ->where('states.ended', true)
            ->whereRaw('DATE(`games`.`timestamp`) <= ?', [
                Carbon::today()->toDateString()
            ]);
    }

    public function scopeHasNotEnded($query)
    {
        return $query
            ->join('states', 'games.state_id', '=', 'states.code')
            ->where('states.ended', false)
            ->whereRaw('DATE(`games`.`timestamp`) >= ?', [
                Carbon::today()->toDateString()
            ]);
    }

    /**
     * Define the relationship to a round
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function round()
    {
        return $this->belongsTo('App\Round');
    }

    /**
     * Define the relationship to a home team
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function home()
    {
        return $this->belongsTo('App\Team', 'home_id');
    }

    /**
     * Define the relationship to a away team
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function away()
    {
        return $this->belongsTo('App\Team', 'away_id');
    }

    /**
     * Define the relationship to a state
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\State', 'state_id', 'code');
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
