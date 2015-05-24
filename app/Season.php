<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    /**
     * Define fields to be treated as Carbon dates
     *
     * @return array
     */
    public function getDates()
    {
        return [
            'start',
            'end',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Define a scope to filter seasons visible to a customer
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @param  int                                  $customer_id
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibleByCustomer($query, $customer_id)
    {
        return $query
            ->join('rounds', 'seasons.id', '=', 'rounds.season_id')
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
     * Define the relationship to rounds
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rounds()
    {
        return $this->hasMany('App\Round');
    }
}
