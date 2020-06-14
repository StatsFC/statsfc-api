<?php
namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function events()
    {
        return $this->hasMany('App\Models\V2\Event');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\V2\Team');
    }
}
