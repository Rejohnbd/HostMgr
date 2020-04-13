<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'               => 'required',
            'customer_type'         => 'required|string',
            'customer_gender'       => 'required|string',
            'company_website'       => 'required|url',
            'company_details'       => 'required|string',
            'customer_address'      => 'required|string',
            'customer_join_date'    => 'required',
            'customer_join_year'    => 'required|integer',
            'full_name'             => 'required|string',
            'contact_mobile'        => 'required|string',
        ];
    }
}
