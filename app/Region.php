<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * Define non-standard table name
     *
     * @var string
     */
    protected $table = 'region';

    /**
     * Define the relationship to competitions
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function competitions()
    {
        return $this->hasMany('App\Competition');
    }
}
