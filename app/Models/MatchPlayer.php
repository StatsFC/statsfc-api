<?php
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class MatchPlayer extends Model
{
    const ROLE_STARTING   = 'starting';
    const ROLE_SUBSTITUTE = 'sub';

    protected $table = 'match_player';

    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'match_id'  => 'integer',
        'team_id'   => 'integer',
        'player_id' => 'integer',
        'number'    => 'integer',
        'role'      => 'string',
    ];

    /**
     * Define a scope to filter match players that have a role
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeHasRole($query)
    {
        return $query->whereIn('match_player.role', [
            static::ROLE_STARTING,
            static::ROLE_SUBSTITUTE,
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
            ->join('players', 'players.id', '=', 'match_player.player_id')
            ->orderByRaw('FIND_IN_SET(`players`.`position`, "G,D,M,A")')
            ->orderBy('match_player.number');
    }

    /**
     * Define a scope to filter team
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
