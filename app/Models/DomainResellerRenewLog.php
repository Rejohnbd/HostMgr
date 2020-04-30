<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainResellerRenewLog extends Model
{
    protected $guarded = [];

    public function domainReseller()
    {
        return $this->belongsTo(DomainReseller::class);
    }
}
