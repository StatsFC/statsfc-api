<?php
namespace App\Models\V1;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RateLimiter extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'customer_id' => 'integer',
        'calls'       => 'integer',
    ];

    /**
     * Define fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'date',
        'calls',
    ];

    /**
     * Define a scope to filter online competitions
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeToday($query)
    {
        return $query->where('date', Carbon::today()->toDateString());
    }

    /**
     * Define the relationship to a customer
     *
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\V1\Customer');
    }

    /**
     * Increment the rate limiter's calls
     *
     * @return void
     */
    public function incrementCalls()
    {
        $this->calls++;
        $this->save();
    }
}
