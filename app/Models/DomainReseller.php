<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainReseller extends Model
{
    protected $fillable = ['name', 'email', 'website', 'details'];

    // public function services()
    // {
    //     return $this->hasMany(Service::class);
    // }

    public function domainRenewLogs()
    {
        return $this->hasMany(DomainResellerRenewLog::class, 'domain_reseller_id');
    }

    public function calculateExpireDate($renewDate, $month)
    {
        return strtotime('+ ' . $month . ' month', strtotime($renewDate));
    }
}
