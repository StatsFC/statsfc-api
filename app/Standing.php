<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    protected $table = 'tables';

    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'competition_id' => 'integer',
        'round_id'       => 'integer',
        'team_id'        => 'integer',
        'position'       => 'integer',
        'played'         => 'integer',
        'wins'           => 'integer',
        'draws'          => 'integer',
        'losses'         => 'integer',
        'for'            => 'integer',
        'against'        => 'integer',
        'difference'     => 'integer',
        'points'         => 'integer',
    ];

    /**
     * Define a scope to filter standings visible to a customer
     *
     * @param  Builder $query
     * @param  integer $customer_id
     * @return Builder
     */
    public function scopeVisibleByCustomer($query, $customer_id)
    {
        return $query
            ->join('competitions', 'tables.competition_id', '=', 'competitions.id')
            ->where('competitions.online', true)
            ->join('payment_competition', 'competitions.id', '=', 'payment_competition.competition_id')
            ->join('payment', 'payment.id', '=', 'payment_competition.payment_id')
            ->whereRaw('? BETWEEN `payment`.`from` AND `payment`.`to`', [
                Carbon::today()->toDateString(),
            ])
            ->where('payment.customer_id', $customer_id);
    }

    /**
     * Define a scope to filter standings by a season
     *
     * @param  Builder $query
     * @param  Request $request
     * @return Builder
     */
    public function scopeFilterSeason($query, $request)
    {
        $query
            ->join('rounds', 'tables.round_id', '=', 'rounds.id')
            ->join('seasons', 'rounds.season_id', '=', 'seasons.id');

        if ($request->has('season')) {
            return $query->where('seasons.name', $request->input('season'));
        }

        // By default, show games for the current season only
        return $query->whereRaw('? BETWEEN `seasons`.`start` AND `seasons`.`end`', [
            Carbon::today()->toDateString(),
        ]);
    }

    /**
     * Define a scope to filter standings by a competition
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
     * Define the relationship to a competition
     *
     * @return BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo('App\Competition');
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
     * Define the relationship to a team
     *
     * @return BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
