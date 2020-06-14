<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    /**
     * Define fields to be casted
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'capacity'  => 'integer',
        'latitude'  => 'decimal',
        'longitude' => 'decimal',
    ];
}
