<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public static function findDomainNameByPaymentId($id)
    {
        $paymentInfo = Payment::where('id', $id)->select('service_id')->first();
        $serviceInfo = Service::where('id', $paymentInfo->service_id)->select('domain_name')->first();
        return $serviceInfo->domain_name;
    }
}
