<?php
namespace App\Models\V2;

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
        return $this->hasMany('App\Models\V2\Event');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\V2\Team');
    }
}
