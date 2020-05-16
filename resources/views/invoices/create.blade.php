@extends('layouts.master')

@section('title', 'Create Invoice')

@section('content')

@component('partials.breadcrumb',[
'title' => 'Create Invoice',
'itemOne' => 'Unread Invoices',
'itemOneUrl' => 'invoices',
'activePage' => 'Crate Invoice'
])
@endcomponent
<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Invoice Info</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <ul class="list-group ">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if($service->customer->customer_type === 'individual')
                                Cutomer Name
                                <span>
                                    {{ $service->customer->customer_first_name }} {{ $service->customer->customer_last_name }}
                                </span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if($service->customer->customer_type === 'individual')
                                Cutomer Type
                                <span>
                                    {{ $service->customer->customer_type }}
                                </span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if($service->customer->customer_type === 'individual')
                                Cutomer Type
                                <span>
                                    {{ $service->customer->customer_type }}
                                </span>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="list-group ">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Name <span>Value</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Crate Invoice </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('invoices.store', ['custId' => $service->customer->id, 'serId' => $service->service->id, 'logId' => $service->id]) }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="invoiceYear" class=" col-form-label text-right text-gray-900">Invoice Year</label>
                            <input data-provide="datepicker" type="text" name="invoice_year" class="form-control @error('invoice_year') is-invalid @enderror" id="invoiceYear" placeholder="Invoice Year" value="{{ old('invoice_year')  }}" required autocomplete="off">
                            @error('invoice_year')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 required">
                            <label for="invoiceFor" class="col-form-label text-right text-gray-900">Invoice For</label>
                            <select name="invoice_item_for" class="form-control  @error('invoice_item_for') is-invalid @enderror" id="invoiceFor" required>
                                <option value="">Select Invoice For</option>
                                <option value="1">New Service</option>
                                <option value="2">Renew Service</option>
                                <option value="3">Others Service</option>
                            </select>
                            @error('invoice_item_for')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="subTotal" class="col-form-label text-right text-gray-900">Service Price</label>
                            <input type="number" name="invoice_item_subtotal" class="form-control @error('invoice_item_subtotal') is-invalid @enderror" id="subTotal" placeholder="Service Price" value="{{ old('invoice_item_subtotal') }}" required>
                            @error('invoice_item_subtotal')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 required">
                            <label for="discount" class="col-form-label text-right text-gray-900">Service Discount</label>
                            <input type="number" name="invoice_item_discount" class="form-control @error('invoice_item_discount') is-invalid @enderror" id="discount" placeholder="Service Discount" value="{{ old('invoice_item_discount') }}" required>
                            @error('invoice_item_discount')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="netAmount" class="col-form-label text-right text-gray-900">Service Amount</label>
                            <input type="number" name="invoice_item_total" class="form-control @error('invoice_item_total') is-invalid @enderror" id="netAmount" placeholder="Service Amount" value="{{ old('invoice_item_total') }}" required>
                            @error('invoice_item_total')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 required">
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

                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="invoiceDetails" class="col-form-label text-right text-gray-900">Invoice Details Info</label>
                            <textarea name="invoice_item_details" class="form-control @error('invoice_item_details') is-invalid @enderror" id="invoiceDetails" rows="3" placeholder="Invoice Details Info" required>{{ old('invoice_item_details') }}</textarea>
                            @error('invoice_item_details')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 required">
                            <label for="paymentDate" class=" col-form-label text-right text-gray-900">Payment Date</label>
                            <input data-provide="datepicker" type="text" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" id="paymentDate" placeholder="Payment Date" value="{{ old('payment_date')  }}" required autocomplete="off">
                            @error('payment_date')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">Save</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('invoices') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
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
        $("#invoiceYear").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
        });

        $("#paymentDate").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
        });

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
    });
</script>
@endsection