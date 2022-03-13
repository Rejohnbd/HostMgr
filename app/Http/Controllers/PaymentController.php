<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Transaction;
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
        $payments = Payment::orderBy('id', 'DESC')->get();
        return view('payment.index', compact('payments'));
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
        $paid_amount = 0;
        $invoiceInfo = Invoice::where('invoice_number', $invoiceNo)->first();
        $serviceInfo = Service::where('id', $invoiceInfo->service_id)->first();
        $paymentInfo = Payment::where('invoice_id', $invoiceInfo->id)->get();

        if (!is_null($paymentInfo)) {
            for ($i = 0; $i < count($paymentInfo); $i++) {
                $paid_amount += $paymentInfo[$i]->paid_amount;
            }
        }

        return view('payment.create')
            ->with('invoiceInfo', $invoiceInfo)
            ->with('serviceInfo', $serviceInfo)
            ->with('paid_amount', $paid_amount);
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
        $lastTransaction = Transaction::latest()->first();
        $invoiceInfo = Invoice::where('invoice_number', $request->invNo)->first();
        if ($invoiceInfo) {
            $attributeNames = $this->paymentStoreAttributes();
            $rules = $this->paymentStoreRules();
            $this->checkValidity($request, $rules, $attributeNames);

            $data['user_id']        = $invoiceInfo->user_id;
            $data['service_id']     = $invoiceInfo->service_id;
            $data['invoice_id']     = $invoiceInfo->id;
            $data['invoice_total']  = $request->invAmout;
            $data['total_amount']   = $request->total_amount;
            $data['paid_amount']    = $request->paid_amount;
            $data['due_amount']     = $request->due_amount;
            $data['payment_date']   = date('Y-m-d', strtotime($request->payment_date));
            $data['created_by']     = Auth::user()->id;

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

                if (is_null($lastTransaction)) {
                    $initialBalance = $this->getInitialBalance();
                    Transaction::create([
                        'payment_id'        => $paymentInfo->id,
                        'income'            => $request->paid_amount,
                        'previous_balance'  => $initialBalance,
                        'present_balance'   => $initialBalance + $request->paid_amount,
                        'description'       => 'Paid Taka ' . $request->paid_amount . ' for service domain ' . $request->service_domain . '. Total Taka ' . $request->total_amount . '. Due Taka ' . ($request->total_amount - $request->paid_amount)
                    ]);
                } else {
                    Transaction::create([
                        'payment_id'        => $paymentInfo->id,
                        'income'            => $request->paid_amount,
                        'previous_balance'  => $lastTransaction->present_balance,
                        'present_balance'   => $lastTransaction->present_balance + $request->paid_amount,
                        'description'       => 'Paid Taka ' . $request->paid_amount . ' for service domain ' . $request->service_domain . '. Total Taka ' . $request->total_amount . '. Due Taka ' . ($request->total_amount - $request->paid_amount)
                    ]);
                }

                session()->flash('success', 'Payment Save Successfully');
                return redirect()->route('payments.index');
            endif;

            if ($request->payment_method === 'bkash') :
                $attributeNames['bkash_mobile_number']     = 'bKash Mobile Number';
                $attributeNames['bkash_transaction_no']    = 'bKash Transaction Number';
                $rules['bkash_mobile_number']              = 'required|string';
                $rules['bkash_transaction_no']             = 'required|string';

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->validate();

                $data['payment_method']         = $request->payment_method;
                $data['bkash_mobile_number']    = $request->bkash_mobile_number;
                $data['bkash_transaction_no']   = $request->bkash_transaction_no;

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

                if (is_null($lastTransaction)) {
                    $initialBalance = $this->getInitialBalance();
                    Transaction::create([
                        'payment_id'        => $paymentInfo->id,
                        'income'            => $request->paid_amount,
                        'previous_balance'  => $initialBalance,
                        'present_balance'   => $initialBalance + $request->paid_amount,
                        'description'       => 'Paid Taka ' . $request->paid_amount . ' for service domain ' . $request->service_domain . '. Total Taka ' . $request->total_amount . '. Due Taka ' . ($request->total_amount - $request->paid_amount)
                    ]);
                } else {
                    Transaction::create([
                        'payment_id'        => $paymentInfo->id,
                        'income'            => $request->paid_amount,
                        'previous_balance'  => $lastTransaction->present_balance,
                        'present_balance'   => $lastTransaction->present_balance + $request->paid_amount,
                        'description'       => 'Paid Taka ' . $request->paid_amount . ' for service domain ' . $request->service_domain . '. Total Taka ' . $request->total_amount . '. Due Taka ' . ($request->total_amount - $request->paid_amount)
                    ]);
                }

                session()->flash('success', 'Payment Save Successfully');
                return redirect()->route('payments.index');
            endif;

            if ($request->payment_method === 'bank') :
                $attributeNames['bank_name']            = 'Bank Name';
                $attributeNames['bank_account_number']  = 'Bank Account Number';
                $rules['bank_name']                     = 'required|string';
                $rules['bank_account_number']           = 'required|string';

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->validate();

                $bankAccData['bank_name']           = $request->bank_name;
                $bankAccData['bank_account_number'] = $request->bank_account_number;
                $bankAccData['created_by']          = auth()->user()->id;
                $bankId = BankAccount::create($bankAccData);

                $data['payment_method']         = $request->payment_method;
                $data['bank_account_id'] = $bankId->id;

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

                if (is_null($lastTransaction)) {
                    $initialBalance = $this->getInitialBalance();
                    Transaction::create([
                        'payment_id'        => $paymentInfo->id,
                        'income'            => $request->paid_amount,
                        'previous_balance'  => $initialBalance,
                        'present_balance'   => $initialBalance + $request->paid_amount,
                        'description'       => 'Paid Taka ' . $request->paid_amount . ' for service domain ' . $request->service_domain . '. Total Taka ' . $request->total_amount . '. Due Taka ' . ($request->total_amount - $request->paid_amount)
                    ]);
                } else {
                    Transaction::create([
                        'payment_id'        => $paymentInfo->id,
                        'income'            => $request->paid_amount,
                        'previous_balance'  => $lastTransaction->present_balance,
                        'present_balance'   => $lastTransaction->present_balance + $request->paid_amount,
                        'description'       => 'Paid Taka ' . $request->paid_amount . ' for service domain ' . $request->service_domain . '. Total Taka ' . $request->total_amount . '. Due Taka ' . ($request->total_amount - $request->paid_amount)
                    ]);
                }

                session()->flash('success', 'Payment Save Successfully');
                return redirect()->route('payments.index');
            endif;
        } else {
            session()->flash('warning', 'Something Happend Wrong');
            return redirect()->route('payments.index');
        }
    }
}
