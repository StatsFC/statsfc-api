<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model {

    protected $table = 'competitionNew';

    public function scopeOnline($query)
    {
        return $query->where('online', true);
    }

    public function region()
    {
        return $this->hasOne('App\Region');
    }

    public function rounds()
    {
        return $this->hasMany('App\Round');
    }

}
