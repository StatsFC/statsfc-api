<?php
namespace App\Models;

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
        return $this->hasMany('App\Models\Competition');
    }
}
