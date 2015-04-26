<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'       => 'integer',
        'vanue_id' => 'integer',
        'national' => 'boolean'
    ];

    /**
     * Define the relationship to a venue
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }
}
