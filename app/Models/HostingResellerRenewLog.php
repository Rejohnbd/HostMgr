<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostingResellerRenewLog extends Model
{
    protected $guarded = [];

    public function hostingReseller()
    {
        return $this->belongsTo(HostingReseller::class);
    }
}
