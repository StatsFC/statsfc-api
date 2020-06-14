<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $casts = [
        'id'      => 'integer',
        'country' => 'string',
        'name'    => 'string',
        'key'     => 'string',
        'enabled' => 'boolean',
    ];

    public function rounds()
    {
        return $this->hasMany('App\Models\Round');
    }

    public function scopeEnabled($query)
    {
        return $query->where('enabled', '=', true);
    }

    public function scopeFilterCountry($query, $request)
    {
        if ($request->has('region')) {
            $query->where('competitions.country', '=', $request->input('region'));
        }

        return $query;
    }

    public function scopeVisibleByCustomer($query, $customer_id)
    {
        return $query
            ->enabled()
            ->join('competition_payment', 'competition_payment.competition_id', '=', 'competitions.id')
            ->join('payments', 'payments.id', '=', 'competition_payment.payment_id')
            ->whereRaw('? BETWEEN `payments`.`from` AND `payments`.`to`', [
                Carbon::today()->toDateString(),
            ])
            ->where('payments.customer_id', $customer_id);
    }
}
