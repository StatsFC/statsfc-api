<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model {

    protected $table = 'season';

    public function rounds()
    {
        return $this->hasMany('App\Round');
    }

}
