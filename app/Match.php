<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model {

    protected $table = 'matchNew';

    public function round()
    {
        return $this->hasOne('App\Round');
    }

    public function state()
    {
        return $this->hasOne('App\State');
    }

}
