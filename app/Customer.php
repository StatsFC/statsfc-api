<?php
namespace App;

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
}
