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
     * Define the relationship to events
     *
     * @return HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
