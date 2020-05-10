<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostingReseller extends Model
{
    protected $fillable = ['name', 'email', 'website', 'details'];

    public function hostingRenewLogs()
    {
        return $this->hasMany(HostingResellerRenewLog::class, 'hosting_reseller_id');
    }

    public function calculateExpireDate($renewDate, $month)
    {
        return strtotime('+ ' . $month . ' month', strtotime($renewDate));
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
