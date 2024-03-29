<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public static function findCustomerNameByUserId($userId)
    {
        $customerInfo = Customer::select('customer_first_name', 'customer_last_name', 'company_name')->where('user_id', $userId)->first();
        if (!is_null($customerInfo->customer_first_name) && !is_null($customerInfo->customer_last_name)) {
            return $customerInfo->customer_first_name . ' ' . $customerInfo->customer_last_name;
        } else {
            return $customerInfo->company_name;
        }
    }
}
