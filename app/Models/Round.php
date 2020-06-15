<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
        'type' => 'string',
    ];

    /**
     * Define the relationship to a season
     *
     * @return BelongsTo
     */
    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    /**
     * Define the relationship to a competition
     *
     * @return BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo('App\Models\Competition');
    }

    /**
     * Define the relationship to matches
     *
     * @return HasMany
     */
    public function matches()
    {
        return $this->hasMany('App\Models\Match');
    }
}
