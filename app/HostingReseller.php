<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostingReseller extends Model
{
    protected $fillable = ['name', 'email', 'website', 'details'];
}
