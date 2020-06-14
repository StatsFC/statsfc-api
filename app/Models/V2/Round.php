<?php
namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
        'type' => 'string',
    ];

    public function competition()
    {
        return $this->belongsTo('App\Models\V2\Competition');
    }

    public function matches()
    {
        return $this->hasMany('App\Models\V2\Match');
    }

    public function season()
    {
        return $this->belongsTo('App\Models\V2\Season');
    }
}
