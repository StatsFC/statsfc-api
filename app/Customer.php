<?php
namespace App;

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
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rateLimiters()
    {
        return $this->hasMany('App\RateLimiter');
    }

    public function competitions($field = null)
    {
        $query = DB::table('competitions')
            ->join('payment_competition', 'competitions.id', '=', 'payment_competition.competition_id')
            ->join('payment', 'payment_competition.payment_id', '=', 'payment.id')
            ->select('competitions.*')
            ->where('payment.customer_id', $this->id)
            ->where('competitions.online', true);

        if ($field) {
            return $query->lists('id');
        }

        return $query->get();
    }
}
