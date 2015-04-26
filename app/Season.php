<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    /**
     * Define non-standard table name
     *
     * @var string
     */
    protected $table = 'season';

    /**
     * Define the relationship to rounds
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rounds()
    {
        return $this->hasMany('App\Round');
    }
}
