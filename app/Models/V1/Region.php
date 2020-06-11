<?php
namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * Define the relationship to competitions
     *
     * @return HasMany
     */
    public function competitions()
    {
        return $this->hasMany('App\Models\V1\Competition');
    }
}
