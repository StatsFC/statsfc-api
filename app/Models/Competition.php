<?php
namespace App\Models;

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
        'id'      => 'integer',
        'enabled' => 'boolean',
    ];

    /**
     * Define a scope to filter enabled competitions
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
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
            ->enabled()
            ->join('competition_payment', 'competitions.id', '=', 'competition_payment.competition_id')
            ->join('payments', 'payments.id', '=', 'competition_payment.payment_id')
            ->whereRaw('? BETWEEN `payments`.`from` AND `payments`.`to`', [
                Carbon::today()->toDateString(),
            ])
            ->where('payments.customer_id', $customer_id);
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
        return $this->belongsTo('App\Models\Region');
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
