<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // protected $fillable = ['user_id', 'customer_type', 'customer_gender', 'company_website', 'company_details', 'customer_address', 'customer_join_date', 'customer_join_year', 'created_by'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customerContactPersons()
    {
        return $this->hasMany(CustomerContactPerson::class);
    }

    public function customerServices()
    {
        return $this->hasMany(Service::class);
    }

    public function serviceLogs()
    {
        return $this->hasMany(ServiceLog::class);
    }
}
