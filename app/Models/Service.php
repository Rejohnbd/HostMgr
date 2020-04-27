<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /*public function domainReseller()
    {
        return $this->belongsTo(DomainReseller::class);
    }

    public function hostingReseller()
    {
        return $this->belongsTo(HostingReseller::class);
    }

    public function hostingPackage()
    {
        return $this->belongsTo(HostingPackage::class);
    }*/
}
