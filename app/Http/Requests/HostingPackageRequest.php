<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HostingPackageRequest extends FormRequest
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
            'name'              => 'required|string',
            'space'             => 'required|string',
            'bandwidth'         => 'required|string',
            'db_qty'            => 'required|string',
            'emails_qty'        => 'required|string',
            'subdomain_qty'     => 'required|string',
            'ftp_qty'           => 'required|string',
            'park_domain_qty'   => 'required|string',
            'addon_domain_qty'  => 'required|string'
        ];
    }
}
