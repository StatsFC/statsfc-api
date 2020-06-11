<?php
namespace App\Models\V1;

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
        'online' => 'boolean',
    ];

    /**
     * Define a scope to filter online competitions
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeOnline($query)
    {
        return $query->where('online', true);
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
            ->online()
            ->join('payment_competition', 'competitions.id', '=', 'payment_competition.competition_id')
            ->join('payment', 'payment.id', '=', 'payment_competition.payment_id')
            ->whereRaw('? BETWEEN `payment`.`from` AND `payment`.`to`', [
                Carbon::today()->toDateString(),
            ])
            ->where('payment.customer_id', $customer_id);
    }

    /**
     * Define a scope to filter competitions by region
     *
     * @param  Builder $query
     * @param  Request $request
     * @return Builder
     */
    public function scopeFilterRegion($query, $request)
    {
        if ($request->has('region')) {
            return $query
                ->join('regions', 'competitions.region_id', '=', 'regions.id')
                ->where('regions.name', $request->input('region'));
        }
    }

    /**
     * Define the relationship to a region
     *
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Models\V1\Region');
    }

    /**
     * Define the relationship to rounds
     *
     * @return HasMany
     */
    public function rounds()
    {
        return $this->hasMany('App\Models\V1\Round');
    }
}
