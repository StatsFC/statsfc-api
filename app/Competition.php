<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model {

    protected $table = 'competition';

    public function scopeOnline($query)
    {
        return $query->where('online', '=', true);
    }

}
