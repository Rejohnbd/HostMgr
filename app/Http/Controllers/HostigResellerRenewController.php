<?php

namespace App\Http\Controllers;

use App\Models\HostingReseller;
use App\Models\HostingResellerRenewLog;
use Illuminate\Http\Request;
use Validator;

class HostigResellerRenewController extends Controller
{
    public function renew(HostingReseller $id)
    {
        return view('hosting-resellers-renew.renew', compact('id'));
    }

    public function store(Request $request)
    {
        $attributeNames['hosting_reseller_renew_date']   = 'Hosting Reseller Renew Date';
        $attributeNames['hosting_reseller_renew_for']    = 'Hosting Reseller Renew Month';
        $attributeNames['hosting_reseller_renew_amount'] = 'Hosting Reseller Renew Amount';

        $rules['hosting_reseller_renew_date']    = 'required:date';
        $rules['hosting_reseller_renew_for']     = 'required|integer|gt:0|lte:12';
        $rules['hosting_reseller_renew_amount']  = 'required|integer|gt:0';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        $reseller = HostingReseller::where('id', '=', $request->hosting_reseller_id)->first();
        if ($reseller) :
            HostingResellerRenewLog::create($request->all());
            session()->flash('success', 'Hosting Reseller Renew Successfully');
            return redirect()->route('hosting-resellers.show', $request->hosting_reseller_id);
        endif;

        session()->flash('warning', 'Something Happend Wrong');
        return redirect()->route('hosting-resellers.show', $request->hosting_reseller_id);
    }

    public function destroy(Request $request)
    {
        $log_id = $request->input('log_id');
        HostingResellerRenewLog::where('id', $log_id)->delete();
        session()->flash('success', 'Hosting Reseller Delete Successfully');
        return redirect()->back();
    }
}
