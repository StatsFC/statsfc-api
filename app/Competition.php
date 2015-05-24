<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'     => 'integer',
        'online' => 'boolean'
    ];

    /**
     * Define a scope to filter online competitions
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnline($query)
    {
        return $query->where('online', true);
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
            ->online()
            ->join('payment_competition', 'competitions.id', '=', 'payment_competition.competition_id')
            ->join('payment', 'payment.id', '=', 'payment_competition.payment_id')
            ->where('payment.from', '<=', Carbon::today()->toDateString())
            ->where('payment.to', '>=', Carbon::today()->toDateString())
            ->where('payment.customer_id', $customer_id);
    }

    /**
     * Define the relationship to a region
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Region');
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
