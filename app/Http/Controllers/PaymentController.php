<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'DESC')->get();
        return view('payment.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function invoicePayment($invoiceNo)
    {
        $invoiceInfo = Invoice::where('invoice_number', $invoiceNo)->first();
        $serviceInfo = Service::where('id', $invoiceInfo->service_id)->first();
        return view('payment.create')
            ->with('invoiceInfo', $invoiceInfo)
            ->with('serviceInfo', $serviceInfo);
    }

    public function paymentStoreAttributes()
    {
        $attributeNames['total_amount']     = 'Total Amount';
        $attributeNames['paid_amount']      = 'Paid Amount';
        $attributeNames['due_amount']       = 'Due Amount';
        $attributeNames['payment_method']   = 'Payment Method';
        $attributeNames['payment_date']     = 'Payment Date';
        return $attributeNames;
    }

    public function paymentStoreRules()
    {
        $rules['total_amount']      = 'required|integer|gt:0';
        $rules['paid_amount']       = 'required|integer|gt:0';
        $rules['due_amount']        = 'required|integer|gt:-1';
        $rules['payment_method']    = 'required|in:cash,bkash,bank';
        $rules['payment_date']      = 'required|date_format:d-m-Y';
        return $rules;
    }

    protected function checkValidity($request, $rules, $attributeNames)
    {
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();
    }

    public function getInitialBalance()
    {
        $initialBalance = DB::table('initial_balance')->select('initial_balance')->where('id', 1)->first();
        return $initialBalance->initial_balance;
    }

    public function storePayment(Request $request)
    {
        // $this->getInitialBalance();
        $invoiceInfo = Invoice::where('invoice_number', $request->invNo)->first();
        if ($invoiceInfo) {
            $attributeNames = $this->paymentStoreAttributes();
            $rules = $this->paymentStoreRules();
            $this->checkValidity($request, $rules, $attributeNames);

            $data['user_id']        = $invoiceInfo->user_id;
            $data['service_id']     = $invoiceInfo->service_id;
            $data['invoice_id']     = $invoiceInfo->id;
            $data['invoice_total']  = $request->invAmout;
            $data['total_amount']   =  $request->total_amount;
            $data['paid_amount']    = $request->paid_amount;
            $data['due_amount']     = $request->due_amount;
            $data['payment_date']   = date('Y-m-d', strtotime($request->payment_date));
            $data['created_by']     = Auth::user()->id;
            // dd($request->all());
            if ($request->payment_method === 'cash') :
                $data['payment_method']   = $request->payment_method;
                $paymentInfo = Payment::create($data);
                if ($request->total_amount == $request->paid_amount) :
                    Service::where('id', '=', $invoiceInfo->service_id)->update(['payment_status' => 1]);
                    $invoiceInfo->payment_status = 1;
                    $invoiceInfo->save();
                else :
                    Service::where('id', '=', $invoiceInfo->service_id)->update(['payment_status' => 2]);
                    $invoiceInfo->payment_status = 2;
                    $invoiceInfo->save();
                endif;
                // $dataTransaction['payment_id']          = $paymentInfo->id;
                // $dataTransaction['income']              = $request->paid_amount;
                // $dataTransaction['previous_balance']    = $request->paid_amount;
                session()->flash('success', 'Payment Save Successfully');
                return redirect()->route('payments.index');
            endif;
        } else {
            session()->flash('warning', 'Something Happend Wrong');
            return redirect()->route('payments.index');
        }
    }
}
