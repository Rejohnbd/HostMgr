<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainReseller extends Model
{
    protected $fillable = ['name', 'email', 'website', 'details'];
}