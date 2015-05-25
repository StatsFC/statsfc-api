<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * Define the relationship to events
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
