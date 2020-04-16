<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostingReseller extends Model
{
    protected $fillable = ['name', 'email', 'website', 'details'];
}