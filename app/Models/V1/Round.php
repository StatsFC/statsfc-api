<?php
namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'     => 'integer',
        'active' => 'boolean',
    ];

    /**
     * Define fields to be treated as Carbon dates
     *
     * @return array
     */
    public function getDates()
    {
        return [
            'start',
            'end',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Define a scope to filter active rounds
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Define the relationship to a season
     *
     * @return BelongsTo
     */
    public function season()
    {
        return $this->belongsTo('App\Models\V1\Season');
    }

    /**
     * Define the relationship to a competition
     *
     * @return BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo('App\Models\V1\Competition');
    }

    /**
     * Define the relationship to games
     *
     * @return HasMany
     */
    public function games()
    {
        return $this->hasMany('App\Models\V1\Game');
    }
}
