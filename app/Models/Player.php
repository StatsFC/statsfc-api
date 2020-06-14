<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    const POSITION_MAP = [
        'A' => 'FW',
        'D' => 'DF',
        'G' => 'GK',
        'M' => 'MF',
    ];

    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }
}
