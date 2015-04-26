<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'     => 'integer',
        'online' => 'boolean'
    ];

    /**
     * Define non-standard table name
     *
     * @var string
     */
    protected $table = 'competitionNew';

    /**
     * Define a scope to filter online competitions
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnline($query)
    {
        return $query->where('online', true);
    }

    /**
     * Define the relationship to a region
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    /**
     * Define the relationship to rounds
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rounds()
    {
        return $this->hasMany('App\Round', 'competitionNew_id');
    }
}
