<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    /**
     * Define non-standard table name
     *
     * @var string
     */
    protected $table = 'matchNew';

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
     * Define the relationship to a state
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
