<?php

namespace App\Http\Controllers;

use App\Models\HostingReseller;
use App\Models\HostingResellerRenewLog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class HostigResellerRenewController extends Controller
{
    public function renew(HostingReseller $id)
    {
        return view('hosting-resellers-renew.renew', compact('id'));
    }

    public function getInitialBalance()
    {
        $initialBalance = DB::table('initial_balance')->select('initial_balance')->where('id', 1)->first();
        return $initialBalance->initial_balance;
    }

    public function store(Request $request)
    {
        $attributeNames['hosting_reseller_renew_date']   = 'Hosting Reseller Renew Date';
        $attributeNames['hosting_reseller_renew_for']    = 'Hosting Reseller Renew Month';
        $attributeNames['hosting_reseller_renew_amount'] = 'Hosting Reseller Renew Amount';

        $rules['hosting_reseller_renew_date']    = 'required|date_format:d-m-Y';
        $rules['hosting_reseller_renew_for']     = 'required|integer|gt:0|lte:12';
        $rules['hosting_reseller_renew_amount']  = 'required|integer|gt:0';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        $reseller = HostingReseller::where('id', '=', $request->hosting_reseller_id)->first();
        if ($reseller) :

            $data['hosting_reseller_id']             =  $request->hosting_reseller_id;
            $data['hosting_reseller_renew_date']     =  date('Y-m-d', strtotime($request->hosting_reseller_renew_date));
            $data['hosting_reseller_renew_for']      =  $request->hosting_reseller_renew_for;
            $data['hosting_reseller_renew_amount']   =  $request->hosting_reseller_renew_amount;

            $renewInfo = HostingResellerRenewLog::create($data);

            $lastTransaction = Transaction::latest()->first();
            if (is_null($lastTransaction)) {
                $initialBalance = $this->getInitialBalance();
                Transaction::create([
                    'hosting_reseller_renew_logs_id'    => $renewInfo->id,
                    'expenses'                          => $request->hosting_reseller_renew_amount,
                    'previous_balance'                  => $initialBalance,
                    'present_balance'                   => $initialBalance - $request->hosting_reseller_renew_amount,
                    'description'                       => 'Paid Taka ' . $request->hosting_reseller_renew_amount . ' for service domain renew.'
                ]);
            } else {
                Transaction::create([
                    'hosting_reseller_renew_logs_id'    => $renewInfo->id,
                    'expenses'                          => $request->hosting_reseller_renew_amount,
                    'previous_balance'                  => $lastTransaction->present_balance,
                    'present_balance'                   => $lastTransaction->present_balance - $request->hosting_reseller_renew_amount,
                    'description'                       => 'Paid Taka ' . $request->hosting_reseller_renew_amount . ' for service domain renew.'
                ]);
            }

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
