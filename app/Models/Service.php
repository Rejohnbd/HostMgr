<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function domainReseller()
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
    }

    public function serviceLogs()
    {
        return $this->hasMany(ServiceLog::class);
    }

    public function serviceItems()
    {
        return $this->hasMany(ServiceItem::class, 'service_id');
    }
}
