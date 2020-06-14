<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RateLimiter extends Model
{
    protected $casts = [
        'id'          => 'integer',
        'customer_id' => 'integer',
        'calls'       => 'integer',
    ];

    protected $fillable = [
        'customer_id',
        'date',
        'calls',
    ];

    public function incrementCalls()
    {
        $this->calls++;
        $this->save();
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function scopeToday($query)
    {
        return $query->where('date', Carbon::today()->toDateString());
    }
}
