<?php
namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * Define the relationship to a team
     *
     * @return BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Models\V1\Team');
    }

    /**
     * Define the relationship to cards
     *
     * @return HasMany
     */
    public function cards()
    {
        return $this->hasMany('App\Models\V1\Card');
    }

    /**
     * Define the relationship to goals
     *
     * @return HasMany
     */
    public function goals()
    {
        return $this->hasMany('App\Models\V1\Goal');
    }

    /**
     * Define the relationship to substitutions
     *
     * @return HasMany
     */
    public function substitutions()
    {
        return $this->hasMany('App\Models\V1\Substitution');
    }
}
