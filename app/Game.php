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
            ->join('competitions', 'rounds.competition_id', '=', 'rounds.id')
            ->join('payment_competition', 'competitions.id', '=', 'payment_competition.competition_id')
            ->join('payment', 'payment.id', '=', 'payment_competition.payment_id')
            ->where('payment.from', '<=', Carbon::today()->toDateString())
            ->where('payment.to', '>=', Carbon::today()->toDateString())
            ->where('payment.customer_id', $customer_id);
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
