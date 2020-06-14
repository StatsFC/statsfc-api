<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'       => 'integer',
        'code'     => 'integer',
        'inGame'   => 'boolean',
        'inPlay'   => 'boolean',
        'hasScore' => 'boolean',
        'knockout' => 'boolean',
        'void'     => 'boolean',
        'break'    => 'boolean',
        'ended'    => 'boolean',
        'length'   => 'integer',
        'offset'   => 'integer',
    ];

    /**
     * Define a scope to filter in-game states
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeNotInGame($query)
    {
        return $query->where('inGame', false);
    }

    /**
     * Define a scope to filter states where the game has ended
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeEnded($query)
    {
        return $query->where('ended', true);
    }

    /**
     * Define a scope to filter states where the game has not ended
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeNotEnded($query)
    {
        return $query->where('ended', false);
    }

    /**
     * Define a scope to filter states where the game is void
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeVoid($query)
    {
        return $query->where('void', true);
    }

    /**
     * Define a scope to filter states where the game is not void
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeNotVoid($query)
    {
        return $query->where('void', false);
    }

    /**
     * Define the relationship to games
     *
     * @return HasMany
     */
    public function games()
    {
        return $this->hasMany('App\Models\Game');
    }

    /**
     * Define the relationship to it's game states
     *
     * @return HasMany
     */
    public function gameStates()
    {
        return $this->hasMany('App\Models\GameState');
    }
}
