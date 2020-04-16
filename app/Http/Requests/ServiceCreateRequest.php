<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCreateRequest extends FormRequest
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
            'customer_id'           => 'required',
            'service_for'           => 'required|integer',
            'domain_name'           => 'required|string',
            'service_start_date'    => 'required|date',
            'service_expire_date'    => 'required|date',
        ];
    }
}
