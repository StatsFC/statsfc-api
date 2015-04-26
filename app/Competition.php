<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $casts = [
        'id'     => 'integer',
        'online' => 'boolean'
    ];

    protected $table = 'competitionNew';

    public function scopeOnline($query)
    {
        return $query->where('online', true);
    }

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function rounds()
    {
        return $this->hasMany('App\Round', 'competitionNew_id');
    }
}
