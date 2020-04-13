<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // protected $fillable = ['user_id', 'customer_type', 'customer_gender', 'company_website', 'company_details', 'customer_address', 'customer_join_date', 'customer_join_year', 'created_by'];
    protected $guarded = [];
}
