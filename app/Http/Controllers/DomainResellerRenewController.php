<?php

namespace App\Http\Controllers;

use App\Models\DomainReseller;
use App\Models\DomainResellerRenewLog;
use Illuminate\Http\Request;
use Validator;

class DomainResellerRenewController extends Controller
{
    public function renew(DomainReseller $id)
    {
        return view('domain-resellers-renew.renew', compact('id'));
    }

    public function store(Request $request)
    {
        $attributeNames['domain_reseller_renew_date']   = 'Domain Reseller Renew Date';
        $attributeNames['domain_reseller_renew_for']    = 'Domain Reseller Renew Month';
        $attributeNames['domain_reseller_renew_amount'] = 'Domain Reseller Renew Amount';

        $rules['domain_reseller_renew_date']    = 'required:date';
        $rules['domain_reseller_renew_for']     = 'required|integer|gt:0|lte:12';
        $rules['domain_reseller_renew_amount']  = 'required|integer|gt:0';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        $reseller = DomainReseller::where('id', '=', $request->domain_reseller_id)->first();
        if ($reseller) :
            DomainResellerRenewLog::create($request->all());
            session()->flash('success', 'Hosting Reseller Renew Successfully');
            return redirect()->route('domain-resellers.index');
        endif;

        session()->flash('warning', 'Something Happend Wrong');
        return redirect()->route('domain-resellers.index');
    }
}
