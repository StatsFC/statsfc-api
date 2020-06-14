<?php
namespace App\Models;

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
        return $this->belongsTo('App\Models\Team');
    }

    /**
     * Define the relationship to cards
     *
     * @return HasMany
     */
    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }

    /**
     * Define the relationship to goals
     *
     * @return HasMany
     */
    public function goals()
    {
        return $this->hasMany('App\Models\Goal');
    }

    /**
     * Define the relationship to substitutions
     *
     * @return HasMany
     */
    public function substitutions()
    {
        return $this->hasMany('App\Models\Substitution');
    }
}
