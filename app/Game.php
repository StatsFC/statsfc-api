<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'round_id'  => 'integer',
        'home_id'   => 'integer',
        'away_id'   => 'integer',
        'state_id'  => 'integer',
        'homeGoals' => 'integer',
        'awayGoals' => 'integer',
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
     * Define the relationship to a round
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function round()
    {
        return $this->belongsTo('App\Round');
    }

    /**
     * Define the relationship to a home team
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function home()
    {
        return $this->belongsTo('App\Team', 'home_id');
    }

    /**
     * Define the relationship to a away team
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function away()
    {
        return $this->belongsTo('App\Team', 'away_id');
    }

    /**
     * Define the relationship to a state
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\State', 'code');
    }
}
