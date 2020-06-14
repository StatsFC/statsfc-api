<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'matches';

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

    public function getDates()
    {
        return [
            'start',
            'created_at',
            'updated_at',
        ];
    }

    public function hasEnded()
    {
        return in_array($this->status, ['Postp.', 'FT', 'Pen.', 'AET', 'Aban.']);
    }

    public function cards()
    {
        return $this->events()->whereIn('events.type', [
            Event::TYPE_RED_CARD,
            Event::TYPE_SECOND_YELLOW_CARD,
            Event::TYPE_YELLOW_CARD,
        ]);
    }

    public function goals()
    {
        return $this->events()->where('events.type', '=', Event::TYPE_GOAL);
    }

    public function substitutions()
    {
        return $this->events()->where('events.type', '=', Event::TYPE_SUBSTITUTION);
    }

    public function away()
    {
        return $this->belongsTo('App\Models\Team', 'away_id');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }

    public function home()
    {
        return $this->belongsTo('App\Models\Team', 'home_id');
    }

    public function matchPlayers()
    {
        return $this->hasMany('App\Models\MatchPlayer');
    }

    public function round()
    {
        return $this->belongsTo('App\Models\Round');
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

    public function scopeFilterTeam($query, $request)
    {
        if ($request->has('team_id')) {
            return $query->whereRaw('? IN (matches.`home_id`, matches.`away_id`)', [
                $request->input('team_id'),
            ]);
        }

        if ($request->has('team')) {
            return $query
                ->join('teams AS home', 'home.id', '=', 'matches.home_id')
                ->join('teams AS away', 'away.id', '=', 'matches.away_id')
                ->whereRaw('? IN (`home`.`name`, `away`.`name`)', [
                    $request->input('team'),
                ]);
        }

        return $query;
    }

    public function scopeHasEnded($query)
    {
        return $query
            ->whereIn('matches.status', ['Postp.', 'FT', 'Pen.', 'AET', 'Aban.'])
            ->whereRaw('DATE(`matches`.`start`) <= ?', [
                Carbon::today()->toDateString(),
            ]);
    }

    public function scopeHasNotEnded($query)
    {
        return $query
            ->whereNotIn('matches.status', ['Postp.', 'FT', 'Pen.', 'AET', 'Aban.'])
            ->whereRaw('DATE(`matches`.`start`) >= ?', [
                Carbon::today()->toDateString(),
            ]);
    }

    public function scopeVisibleByCustomer($query, $customer_id)
    {
        return $query
            ->join('competitions', 'competitions.id', '=', 'matches.competition_id')
            ->join('competition_payment', 'competition_payment.competition_id', '=', 'competitions.id')
            ->join('payments', 'payments.id', '=', 'competition_payment.payment_id')
            ->where('competitions.enabled', '=', true)
            ->whereRaw('? BETWEEN `payments`.`from` AND `payments`.`to`', [
                Carbon::today()->toDateString(),
            ])
            ->where('payments.customer_id', $customer_id);
    }
}
