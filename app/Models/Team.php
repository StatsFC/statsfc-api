<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
    ];

    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }

    public function players()
    {
        return $this->hasMany('App\Models\Player');
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
            $query->where('seasons.name', $request->input('season'));
        }

        return $query;
    }

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

    public function scopeVisibleByCustomer($query, $customer_id)
    {
        return $query
            ->join('matches', function ($join) {
                $join->on('matches.home_id', '=', 'teams.id')
                    ->orOn('matches.away_id', '=', 'teams.id');
            })
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
