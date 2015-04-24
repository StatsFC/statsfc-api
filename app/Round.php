<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model {

    protected $table = 'round';

    public function season()
    {
        return $this->hasOne('App\Season');
    }

    public function competition()
    {
        return $this->hasOne('App\Competition');
    }

    public function matches()
    {
        return $this->hasMany('App\Match');
    }

}
