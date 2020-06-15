<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    const STATUS_ABANDONED        = 'Aban.';
    const STATUS_AFTER_EXTRA_TIME = 'AET';
    const STATUS_FULL_TIME        = 'FT';
    const STATUS_PENALTIES        = 'Pen.';
    const STATUS_POSTPONED        = 'Postp.';

    protected $table = 'matches';

    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'round_id'        => 'integer',
        'season_id'       => 'integer',
        'competition_id'  => 'integer',
        'home_id'         => 'integer',
        'away_id'         => 'integer',
        'week'            => 'integer',
        'status'          => 'string',
        'home_score'      => 'integer',
        'home_score_ht'   => 'integer',
        'home_score_ft'   => 'integer',
        'home_score_et'   => 'integer',
        'home_score_pens' => 'integer',
        'home_score_agg'  => 'integer',
        'away_score'      => 'integer',
        'away_score_ht'   => 'integer',
        'away_score_ft'   => 'integer',
        'away_score_et'   => 'integer',
        'away_score_pens' => 'integer',
        'away_score_agg'  => 'integer',
    ];

    /**
     * Define fields to be treated as Carbon dates
     *
     * @return array
     */
    public function getDates()
    {
        return [
            'start',
            'created_at',
            'updated_at',
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
     * @return Builder
     */
    public function scopeFilterTeam($query, $request)
    {
        if ($request->has('team_id')) {
            return $query->whereRaw('? IN (matches.`home_id`, matches.`away_id`)', [
                $request->input('team_id'),
            ]);
        }

        if ($request->has('team')) {
            return $query
                ->join('teams AS home', 'matches.home_id', '=', 'home.id')
                ->join('teams AS away', 'matches.away_id', '=', 'away.id')
                ->whereRaw('? IN (`home`.`name`, `away`.`name`)', [
                    $request->input('team'),
                ]);
        }
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
        if ($request->has('season_id')) {
            return $query->where('matches.season_id', '=', $request->input('season_id'));
        }

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
    }

    /**
     * Define a scope to filter matches by from/to dates
     *
     * @param  Builder $query
     * @param  Request $request
     * @return Builder
     */
    public function scopeFilterDates($query, $request)
    {
        if ($request->has('from')) {
            $query->whereRaw('DATE(`matches`.`start`) >= ?', [
                $request->input('from'),
            ]);
        }

        if ($request->has('to')) {
            $query->whereRaw('DATE(`matches`.`start`) <= ?', [
                $request->input('to'),
            ]);
        }

        return $query;
    }

    /**
     * Define a scope to filter matches that have ended
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeHasEnded($query)
    {
        return $query
            ->whereIn('matches.status', ['Postp.', 'FT', 'Pen.', 'AET', 'Aban.'])
            ->whereRaw('DATE(`matches`.`start`) <= ?', [
                Carbon::today()->toDateString(),
            ]);
    }

    /**
     * Define a scope to filter matches that have not ended
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeHasNotEnded($query)
    {
        return $query
            ->whereNotIn('matches.status', ['Postp.', 'FT', 'Pen.', 'AET', 'Aban.'])
            ->whereRaw('DATE(`matches`.`start`) >= ?', [
                Carbon::today()->toDateString(),
            ]);
    }

    /**
     * Define the relationship to a round
     *
     * @return BelongsTo
     */
    public function round()
    {
        return $this->belongsTo('App\Models\Round');
    }

    /**
     * Define the relationship to a home team
     *
     * @return BelongsTo
     */
    public function home()
    {
        return $this->belongsTo('App\Models\Team', 'home_id');
    }

    /**
     * Define the relationship to a away team
     *
     * @return BelongsTo
     */
    public function away()
    {
        return $this->belongsTo('App\Models\Team', 'away_id');
    }

    /**
     * Define the relationship to it's cards
     */
    public function cards()
    {
        return $this->events()->whereIn('events.type', [
            Event::TYPE_RED_CARD,
            Event::TYPE_SECOND_YELLOW_CARD,
            Event::TYPE_YELLOW_CARD,
        ]);
    }

    /**
     * Define the relationship to it's goals
     */
    public function goals()
    {
        return $this->events()->where('events.type', '=', Event::TYPE_GOAL);
    }

    /**
     * Define the relationship to it's substitutions
     */
    public function substitutions()
    {
        return $this->events()->where('events.type', '=', Event::TYPE_SUBSTITUTION);
    }

    /**
     * Define the relationship to it's players
     *
     * @return HasMany
     */
    public function matchPlayers()
    {
        return $this->hasMany('App\Models\MatchPlayer');
    }

    /**
     * Return whether or not the match has ended
     *
     * @return boolean
     */
    public function hasEnded()
    {
        return in_array($this->status, [
            self::STATUS_POSTPONED,
            self::STATUS_FULL_TIME,
            self::STATUS_PENALTIES,
            self::STATUS_AFTER_EXTRA_TIME,
            self::STATUS_ABANDONED,
        ]);
    }
}
