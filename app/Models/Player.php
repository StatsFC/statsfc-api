<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    const POSITION_MAP = [
        'A' => 'FW',
        'D' => 'DF',
        'G' => 'GK',
        'M' => 'MF',
    ];

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
     * Define the relationship to events
     *
     * @return HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }
}
