<?php
namespace App;

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
        'active' => 'boolean'
    ];

    /**
     * Define non-standard table name
     *
     * @var string
     */
    protected $table = 'round';

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
            'updated_at'
        ];
    }

    /**
     * Define a scope to filter active rounds
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Define the relationship to a season
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    /**
     * Define the relationship to a competition
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo('App\Competition', 'competitionNew_id');
    }

    /**
     * Define the relationship to matches
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matches()
    {
        return $this->hasMany('App\Match');
    }
}
