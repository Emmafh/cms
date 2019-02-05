<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    
    /**
     * The fields that allow mass assignment.
     *
     * @var array 
     */
    protected $fillable = ['code', 'name', 'description'];

}
