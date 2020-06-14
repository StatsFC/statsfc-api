<?php
namespace App\Models\V2;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function rateLimiters()
    {
        return $this->hasMany('App\Models\V2\RateLimiter');
    }

    public function competitions()
    {
        return DB::table('competitions')
            ->select('competitions.*')
            ->join('competition_payment', 'competition_payment.competition_id', '=', 'competitions.id')
            ->join('payments', 'payments.id', '=', 'competition_payment.payment_id')
            ->where('payments.customer_id', $this->id)
            ->where('payments.type', 'API')
            ->where('payments.from', '<=', Carbon::today()->toDateString())
            ->where('payments.to', '>=', Carbon::today()->toDateString())
            ->where('competitions.enabled', '=', true)
            ->lists('id');
    }

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
