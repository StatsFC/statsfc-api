<?php
namespace App\Models;

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
        return $this->belongsTo('App\Models\Competition');
    }

    public function matches()
    {
        return $this->hasMany('App\Models\Match');
    }

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }
}
