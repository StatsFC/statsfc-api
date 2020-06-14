<?php
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class MatchPlayer extends Model
{
    const ROLE_STARTING   = 'starting';
    const ROLE_SUBSTITUTE = 'sub';

    protected $table = 'match_player';

    protected $casts = [
        'match_id'  => 'integer',
        'team_id'   => 'integer',
        'player_id' => 'integer',
        'number'    => 'integer',
        'role'      => 'string',
    ];

    public function match()
    {
        return $this->belongsTo('App\Models\Match');
    }

    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function scopeFilterTeam($query, $team_id)
    {
        return $query->where('team_id', '=', $team_id);
    }

    public function scopeHasRole($query)
    {
        return $query->whereIn('match_player.role', [
            static::ROLE_STARTING,
            static::ROLE_SUBSTITUTE,
        ]);
    }

    public function scopeOrderByPosition($query)
    {
        return $query
            ->join('players', 'players.id', '=', 'match_player.player_id')
            ->orderByRaw('FIND_IN_SET(`players`.`position`, "G,D,M,A")')
            ->orderBy('match_player.number');
    }
}
