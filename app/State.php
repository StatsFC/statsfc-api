<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * Define non-standard table name
     *
     * @var string
     */
    protected $table = 'stateNew';

    /**
     * Define a scope to filter in-game states
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotInGame($query)
    {
        return $query->where('inGame', false);
    }

    /**
     * Define a scope to filter states where the match has ended
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnded($query)
    {
        return $query->where('ended', true);
    }

    /**
     * Define a scope to filter states where the match has not ended
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotEnded($query)
    {
        return $query->where('ended', false);
    }

    /**
     * Define a scope to filter states where the match is void
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeVoid($query)
    {
        return $query->where('void', true);
    }

    /**
     * Define a scope to filter states where the match is not void
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotVoid($query)
    {
        return $query->where('void', false);
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
