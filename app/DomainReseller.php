<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DomainReseller extends Model
{
    protected $fillable = ['name', 'email', 'website', 'details'];
}
