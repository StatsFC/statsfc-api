<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'game_id'    => 'integer',
        'team_id'    => 'integer',
        'state_id'   => 'integer',
        'player_id'  => 'integer',
        'player2_id' => 'integer',
        'homeGoals'  => 'integer',
        'awayGoals'  => 'integer',
    ];

    /**
     * Define fields to be treated as Carbon dates
     *
     * @return array
     */
    public function getDates()
    {
        return [
            'timestamp',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Define the relationship to a game
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    /**
     * Define the relationship to a team
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    /**
     * Define the relationship to a state
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
     * Define the relationship to a player
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function player()
    {
        return $this->belongsTo('App\Player');
    }

    /**
     * Define the relationship to a second player
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function player2()
    {
        return $this->belongsTo('App\Player', 'player2_id');
    }
}
