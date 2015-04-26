<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Define non-standard table name
     *
     * @var string
     */
    protected $table = 'customer';
}
