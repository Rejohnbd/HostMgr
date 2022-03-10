@extends('layouts.master')

@section('title', 'Payment Invoice')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Payment for Invoice No ' .$invoiceInfo->invoice_number,
'itemOne' => 'Payment List',
'itemOneUrl' => 'payments.index',
'activePage' => 'Payment'
])
@endcomponent

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Payment</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('payments.store', ['invNo' => $invoiceInfo->invoice_number, 'invAmout' => $invoiceInfo->invoice_total]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="paymentUser" class="col-form-label text-right text-gray-900">Service Holder Email</label>
                        <input type="text" class="form-control" id="paymentUser" value="{{ $invoiceInfo->user->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="paymentUser" class="col-form-label text-right text-gray-900">Service Domain</label>
                        <input type="text" class="form-control" id="paymentUser" value="{{ $serviceInfo->domain_name }}" disabled>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="totalAmount" class="col-form-label text-right text-gray-900">Total Amount</label>
                            <input class="form-control" id="totalAmount" value="{{ floor($invoiceInfo->invoice_total) }}" disabled>
                            <input type="hidden" name="total_amount" value="{{ floor($invoiceInfo->invoice_total) }}" required>
                        </div>

                        <div class="form-group col-md-4 required">
                            <label for="paidAmount" class="col-form-label text-right text-gray-900">Paid Amount</label>
                            <input type="number" name="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" id="paidAmount" placeholder="Paid Discount" value="{{ old('paid_amount') }}" required>
                            @error('paid_amount')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 required">
                            <label for="dueAmount" class="col-form-label text-right text-gray-900">Due Amount</label>
                            <input type="number" name="due_amount" class="form-control @error('due_amount') is-invalid @enderror" id="dueAmount" placeholder="Due Amount" value="{{ old('due_amount') }}" required>
                            @error('due_amount')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group required">
                        <label for="paymentType" class="col-form-label text-right text-gray-900">Payment Type</label>
                        <select name="payment_method" class="form-control  @error('payment_method') is-invalid @enderror" id="paymentType" required>
                            <option value="">Select Payment Type</option>
                            <option value="cash">Cash Payment</option>
                            <option value="bkash">bKash Payment</option>
                            <option value="bank">Bank Payment</option>
                        </select>
                        @error('payment_method')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row bkash-info">
                        <div class="form-group col-md-6 required">
                            <label for="bkashMobile" class="col-form-label text-right text-gray-900">bKash Mobile Number</label>
                            <input type="text" name="bkash_mobile_number" class="form-control @error('bkash_mobile_number') is-invalid @enderror" id="bkashMobile" placeholder="bKash Mobile Number" value="{{ old('bkash_mobile_number') }}">
                            @error('bkash_mobile_number')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 required">
                            <label for="bkashTransNo" class="col-form-label text-right text-gray-900">bKash Transaction No</label>
                            <input type="text" name="bkash_transaction_no" class="form-control @error('bkash_transaction_no') is-invalid @enderror" id="bkashTransNo" placeholder="bKash Transaction No" value="{{ old('bkash_transaction_no') }}">
                            @error('bkash_transaction_no')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row bank-info">
                        <div class="form-group col-md-6 required">
                            <label for="bankName" class="col-form-label text-right text-gray-900">Bank Name</label>
                            <input type="text" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" id="bankName" placeholder="Bank Name" value="{{ old('bank_name') }}">
                            @error('bank_name')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 required">
                            <label for="bankAccNo" class="col-form-label text-right text-gray-900">Bank Account No</label>
                            <input type="text" name="bank_account_number" class="form-control @error('bank_account_number') is-invalid @enderror" id="bankAccNo" placeholder="Bank Account No" value="{{ old('bank_account_number') }}">
                            @error('bank_account_number')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group required">
                        <label for="paymentDate" class=" col-form-label text-right text-gray-900">Payment Date</label>
                        <input data-provide="datepicker" type="text" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" id="paymentDate" placeholder="Payment Date" value="{{ old('payment_date')  }}" required autocomplete="off">
                        @error('payment_date')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">Save</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('payments.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.bkash-info').hide();
        $('.bank-info').hide();
        $("#paymentType").on("change", function() {
            var paymentType = $(this).children(":selected").val();
            if (paymentType === 'bkash') {
                $('.bkash-info').show();
                $('.bank-info').hide();
            } else if (paymentType === 'bank') {
                $('.bkash-info').hide();
                $('.bank-info').show();
            } else {
                $('.bkash-info').hide();
                $('.bank-info').hide();
            }
        });
        $("#paymentDate").datepicker({
            format: "dd-mm-yyyy",
            todayHighlight: true,
        });
        $('#paidAmount').on('keyup change', function() {
            let total_amount = $('#totalAmount').val();
            let paid_amount = $(this).val();
            $('#dueAmount').val(total_amount - paid_amount);
        });
    })
</script>

@if($errors->has('bkash_mobile_number') || $errors->has('bkash_transaction_no'))
<script>
    $(document).ready(function() {
        $('#paymentType').val("bkash");
        $('.bkash-info').show();
    });
</script>
@endif

@if($errors->has('bank_name') || $errors->has('bank_account_number'))
<script>
    $(document).ready(function() {
        $('#paymentType').val("bank");
        $('.bank-info').show();
    });
</script>
@endif
@endsection