<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    protected $table = 'region';

    public function competitions()
    {
        return $this->hasMany('App\Competition');
    }

}
