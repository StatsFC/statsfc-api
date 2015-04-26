<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $casts = [
        'id'     => 'integer',
        'active' => 'boolean'
    ];

    protected $table = 'round';

    public function getDates()
    {
        return [
            'start',
            'end',
            'created_at',
            'updated_at'
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    public function competition()
    {
        return $this->belongsTo('App\Competition', 'competitionNew_id');
    }

    public function matches()
    {
        return $this->hasMany('App\Match');
    }
}
