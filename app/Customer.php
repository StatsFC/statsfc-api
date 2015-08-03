<?php
namespace App;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Define non-standard table name
     *
     * @var string
     */
    protected $table = 'customer';

    /**
     * Define the relationship to rate limiters
     *
     * @return HasMany
     */
    public function rateLimiters()
    {
        return $this->hasMany('App\RateLimiter');
    }

    /**
     * Get the competitions a customer is sibscribed to
     *
     * @param  string  $field  Field name to return a list of
     * @return Collection
     */
    public function competitions($field = null)
    {
        $query = DB::table('competitions')
            ->join('payment_competition', 'competitions.id', '=', 'payment_competition.competition_id')
            ->join('payment', 'payment_competition.payment_id', '=', 'payment.id')
            ->select('competitions.*')
            ->where('payment.customer_id', $this->id)
            ->where('payment.type', 'API')
            ->where('payment.from', '<=', Carbon::today()->toDateString())
            ->where('payment.to', '>=', Carbon::today()->toDateString())
            ->where('competitions.online', true);

        if ($field) {
            return $query->lists($field)->all();
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
        $query = DB::table('payment')
            ->select('dailyRateLimit')
            ->where('customer_id', $this->id)
            ->where('type', 'API')
            ->where('from', '<=', Carbon::today()->toDateString())
            ->where('to', '>=', Carbon::today()->toDateString());

        $payments = $query->get();

        if (count($payments) === 0) {
            return false;
        }

        return (int) $payments[0]->dailyRateLimit;
    }
}
