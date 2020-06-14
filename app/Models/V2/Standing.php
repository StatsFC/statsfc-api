<?php
namespace App\Models\V2;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    protected $casts = [
        'id'                 => 'integer',
        'season_id'          => 'integer',
        'competition_id'     => 'integer',
        'group'              => 'string',
        'team_id'            => 'integer',
        'position'           => 'integer',
        'played'             => 'integer',
        'won'                => 'integer',
        'drawn'              => 'integer',
        'lost'               => 'integer',
        'goals_for'          => 'integer',
        'goals_against'      => 'integer',
        'goal_difference'    => 'integer',
        'points'             => 'integer',
        'home_played'        => 'integer',
        'home_won'           => 'integer',
        'home_drawn'         => 'integer',
        'home_lost'          => 'integer',
        'home_goals_for'     => 'integer',
        'home_goals_against' => 'integer',
        'away_played'        => 'integer',
        'away_won'           => 'integer',
        'away_drawn'         => 'integer',
        'away_lost'          => 'integer',
        'away_goals_for'     => 'integer',
        'away_goals_against' => 'integer',
        'status'             => 'string',
        'form'               => 'string',
        'description'        => 'string',
    ];

    public function competition()
    {
        return $this->belongsTo('App\Models\V2\Competition');
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
        $query->join('seasons', 'seasons.id', '=', 'standings.season_id');

        if ($request->has('season')) {
            $query->where('seasons.name', $request->input('season'));
        }

        return $query;
    }

    public function scopeVisibleByCustomer($query, $customer_id)
    {
        return $query
            ->join('competitions', 'competitions.id', '=', 'standings.competition_id')
            ->where('competitions.enabled', '=', true)
            ->join('competition_payment', 'competition_payment.competition_id', '=', 'competitions.id')
            ->join('payments', 'payments.id', '=', 'competition_payment.payment_id')
            ->whereRaw('? BETWEEN `payments`.`from` AND `payments`.`to`', [
                Carbon::today()->toDateString(),
            ])
            ->where('payments.customer_id', $customer_id);
    }
}
