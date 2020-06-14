<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
    ];

    public function competitions()
    {
        return $this->hasMany('App\Models\Competition');
    }

    public function matches()
    {
        return $this->hasMany('App\Models\Match');
    }

    public function rounds()
    {
        return $this->hasMany('App\Models\Round');
    }

    public function scopeVisibleByCustomer($query, $customer_id)
    {
        return $query
            ->join('competitions', 'competitions.id', '=', 'seasons.competition_id')
            ->where('competitions.enabled', '=', true)
            ->join('competition_payment', 'competition_payment.competition_id', '=', 'competitions.id')
            ->join('payments', 'payments.id', '=', 'competition_payment.payment_id')
            ->whereRaw('? BETWEEN `payments`.`from` AND `payments`.`to`', [
                Carbon::today()->toDateString(),
            ])
            ->where('payments.customer_id', $customer_id);
    }
}
