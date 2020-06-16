<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
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
     * Define a scope to filter seasons visible to a customer
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
     * Define the relationship to competitions
     *
     * @return HasMany
     */
    public function competitions()
    {
        return $this->hasMany('App\Models\Competition');
    }

    /**
     * Define the relationship to matches
     *
     * @return HasMany
     */
    public function matches()
    {
        return $this->hasMany('App\Models\Match');
    }

    /**
     * Define the relationship to rounds
     *
     * @return HasMany
     */
    public function rounds()
    {
        return $this->hasMany('App\Models\Round');
    }
}
