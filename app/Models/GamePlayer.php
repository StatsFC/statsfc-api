<?php
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class GamePlayer extends Model
{
    protected $table = 'game_players';

    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'game_id'   => 'integer',
        'team_id'   => 'integer',
        'player_id' => 'integer',
        'number'    => 'integer',
    ];

    /**
     * Define a scope to filter game players that have a role
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeHasRole($query)
    {
        return $query->whereIn('role', [
            'starting',
            'sub',
        ]);
    }

    /**
     * Define a scope to order by position, then number
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeOrderByPosition($query)
    {
        return $query
            ->orderByRaw('FIND_IN_SET(`game_players`.`position`, "GK,DF,MF,FW")')
            ->orderBy('number');
    }

    /**
     * Define a scope to filter home players
     *
     * @param  Builder $query
     * @param  integer $team_id
     * @return Builder
     */
    public function scopeFilterTeam($query, $team_id)
    {
        return $query->where('team_id', $team_id);
    }

    /**
     * Define the relationship to a player
     *
     * @return BelongsTo
     */
    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }
}
