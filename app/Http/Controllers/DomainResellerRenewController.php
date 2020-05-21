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

        $rules['domain_reseller_renew_date']    = 'required|date_format:d-m-Y';
        $rules['domain_reseller_renew_for']     = 'required|integer|gt:0|lte:12';
        $rules['domain_reseller_renew_amount']  = 'required|integer|gt:0';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        $reseller = DomainReseller::where('id', '=', $request->domain_reseller_id)->first();
        if ($reseller) :

            $data['domain_reseller_id']             =  $request->domain_reseller_id;
            $data['domain_reseller_renew_date']     =  date('Y-m-d', strtotime($request->domain_reseller_renew_date));
            $data['domain_reseller_renew_for']      =  $request->domain_reseller_renew_for;
            $data['domain_reseller_renew_amount']   =  $request->domain_reseller_renew_amount;

            DomainResellerRenewLog::create($data);
            session()->flash('success', 'Domain Reseller Renew Successfully');
            return redirect()->route('domain-resellers.show', $request->domain_reseller_id);
        endif;

        session()->flash('warning', 'Something Happend Wrong');
        return redirect()->route('domain-resellers.show', $request->domain_reseller_id);
    }

    public function destroy(Request $request)
    {
        $log_id = $request->input('log_id');
        DomainResellerRenewLog::where('id', $log_id)->delete();
        session()->flash('success', 'Domain Reseller Delete Successfully');
        return redirect()->back();
    }
}
