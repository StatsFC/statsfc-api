<?php
namespace App;

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
        return $this->belongsTo('App\Team');
    }

    /**
     * Define the relationship to cards
     *
     * @return HasMany
     */
    public function cards()
    {
        return $this->hasMany('App\Card');
    }

    /**
     * Define the relationship to goals
     *
     * @return HasMany
     */
    public function goals()
    {
        return $this->hasMany('App\Goal');
    }

    /**
     * Define the relationship to substitutions
     *
     * @return HasMany
     */
    public function substitutions()
    {
        return $this->hasMany('App\Substitution');
    }
}
