<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    protected $table = 'stateNew';

    public function scopeNotInGame($query)
    {
        return $query->where('inGame', false);
    }

    public function scopeEnded($query)
    {
        return $query->where('ended', true);
    }

    public function scopeNotEnded($query)
    {
        return $query->where('ended', false);
    }

    public function scopeVoid($query)
    {
        return $query->where('void', true);
    }

    public function scopeNotVoid($query)
    {
        return $query->where('void', false);
    }

    public function matches()
    {
        return $this->hasMany('App\Match');
    }

}
