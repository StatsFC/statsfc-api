<?php
namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $casts = [
        'id'                  => 'integer',
        'ip'                  => 'string',
        'lift_ip_restriction' => 'boolean',
    ];

    /**
     * Define the relationship to rate limiters
     *
     * @return HasMany
     */
    public function rateLimiters()
    {
        return $this->hasMany('App\Models\RateLimiter');
    }

    /**
     * Get the competitions a customer is subscribed to
     *
     * @param  string  $field  Field name to return a list of
     * @return Collection
     */
    public function competitions($field = null)
    {
        $query = DB::table('competitions')
            ->join('competition_payment', 'competitions.id', '=', 'competition_payment.competition_id')
            ->join('payments', 'competition_payment.payment_id', '=', 'payments.id')
            ->select('competitions.*')
            ->where('payments.customer_id', $this->id)
            ->where('payments.type', 'API')
            ->where('payments.from', '<=', Carbon::today()->toDateString())
            ->where('payments.to', '>=', Carbon::today()->toDateString())
            ->where('competitions.enabled', true);

        if ($field) {
            return $query->lists($field);
        }

        return $query->get();
    }

    /**
     * Get the current daily rate limit
     *
     * @return boolean|integer
     */
    public function dailyRateLimit()
    {
        $query = DB::table('payments')
            ->select('daily_rate_limit')
            ->where('customer_id', $this->id)
            ->where('type', 'API')
            ->where('from', '<=', Carbon::today()->toDateString())
            ->where('to', '>=', Carbon::today()->toDateString());

        $payments = $query->get();

        if (count($payments) === 0) {
            return false;
        }

        return (int) $payments[0]->daily_rate_limit;
    }
}
