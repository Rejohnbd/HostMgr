@extends('layouts.master')

@section('title', 'Update Invoice')

@section('content')

@component('partials.breadcrumb',[
'title' => 'Update Invoice',

'activePage' => 'Update Invoice'
])
@endcomponent

@if(session('warning'))
@include('partials.warning-alert')
@endif

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Service Info</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        @if($service->customer->customer_type === 'individual')
                        <ul class="list-group ">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Cutomer Name</strong>
                                <span>
                                    {{ $service->customer->customer_first_name }} {{ $service->customer->customer_last_name }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Customer Email</strong>
                                <span>
                                    {{ $service->user->email }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Address</strong>
                                <span>
                                    {{ $service->customer->customer_address }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Join Date</strong>
                                <span>
                                    {{ $service->customer->customer_join_date }}
                                </span>
                            </li>
                        </ul>
                        @endif
                        @if($service->customer->customer_type === 'company')
                        <ul class="list-group ">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Company Name</strong>
                                <span>
                                    {{ $service->customer->company_name }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Company Email</strong>
                                <span>
                                    {{ $service->user->email }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Company Details</strong>
                                <span>
                                    {{ $service->customer->company_details }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Address</strong>
                                <span>
                                    {{ $service->customer->customer_address }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Join Date</strong>
                                <span>
                                    {{ $service->customer->customer_join_date }}
                                </span>
                            </li>
                        </ul>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="list-group ">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Service For </strong>
                                <span>{{ ucfirst($service->serviceLogs->first()->service_log_for)}} Service</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Service Types </strong>
                                <div class="d-flex justify-content-end">
                                    @foreach($service->serviceItems as $serviceItem)
                                    @if($serviceItem->service_type_id === 1)
                                    <span class="badge badge-success m-1">{{ 'Domain' }}</span>
                                    @endif
                                    @if($serviceItem->service_type_id === 2)
                                    <span class="badge badge-primary m-1">{{ 'Hosting' }}</span>
                                    @endif
                                    @if($serviceItem->service_type_id === 3)
                                    <span class="badge badge-warning m-1">{{ 'Others' }}</span>
                                    @endif
                                    @endforeach
                                </div>
                            </li>
                            @if($service->serviceItems->first()->item_details)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-primary">Service Item Details </strong>
                                <span>{{ ucfirst($service->serviceItems->first()->item_details)}} </span>
                            </li>
                            @endif
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
                <h6 class="m-0 font-weight-bold text-primary">Update Invoice </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('invoices.update', ['userId' => $service->user->id, 'serId' => $service->id, 'invNo' => $invoiceInfo->invoice_number]) }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="invoiceYear" class=" col-form-label text-right text-gray-900">Invoice Year</label>
                            <input data-provide="datepicker" type="text" name="invoice_year" class="form-control @error('invoice_year') is-invalid @enderror" id="invoiceYear" placeholder="Invoice Year" value="{{ old('invoice_year', $invoiceInfo->invoice_year)  }}" required autocomplete="off">
                            @error('invoice_year')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 required">
                            <label for="invoiceFor" class="col-form-label text-right text-gray-900">Invoice For</label>
                            <select name="invoice_item_for" class="form-control  @error('invoice_item_for') is-invalid @enderror" id="invoiceFor" required>
                                <option value="">Select Invoice For</option>
                                <option value="1" @php foreach($invoiceInfo->invoiceItems as $item){ if($item->invoice_item_for == 1) {echo "selected"; break; }} @endphp>New Service</option>
                                <option value="2" @php foreach($invoiceInfo->invoiceItems as $item){ if($item->invoice_item_for == 2) {echo "selected"; break; }} @endphp>Renew Service</option>
                            </select>
                            @error('invoice_item_for')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    @foreach($service->serviceItems as $serviceItem)
                    @if($serviceItem->service_type_id === 1)
                    <div class="form-row">
                        <div class="form-group col-md-4 required">
                            <label for="domainSubTotal" class="col-form-label text-right text-gray-900">Domain Fee</label>
                            <input type="number" name="domain_invoice_item_subtotal" class="form-control @error('domain_invoice_item_subtotal') is-invalid @enderror" id="domainSubTotal" placeholder="Domain Fee" value="@php foreach($invoiceInfo->invoiceItems as $item){ if($item->service_type_id == 1) {echo $item->invoice_item_subtotal; }} @endphp" required>
                            @error('domain_invoice_item_subtotal')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 required">
                            <label for="domainDiscount" class="col-form-label text-right text-gray-900">Domain Discount</label>
                            <input type="number" name="domain_invoice_item_discount" class="form-control @error('domain_invoice_item_discount') is-invalid @enderror" id="domainDiscount" placeholder="Domain Discount" value="@php foreach($invoiceInfo->invoiceItems as $item){ if($item->service_type_id == 1) {echo $item->invoice_item_discount; }} @endphp" required>
                            @error('domain_invoice_item_discount')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 required">
                            <label for="domainNetAmount" class="col-form-label text-right text-gray-900">Net Amount</label>
                            <input type="number" name="domain_invoice_item_total" class="form-control @error('domain_invoice_item_total') is-invalid @enderror" id="domainNetAmount" placeholder="Net Amount" value="@php foreach($invoiceInfo->invoiceItems as $item){ if($item->service_type_id == 1) {echo $item->invoice_item_total; }} @endphp" required>
                            @error('domain_invoice_item_total')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="hidden" name="service_type_id[]" value="{{$serviceItem->service_type_id}}">
                    </div>
                    @endif
                    @if($serviceItem->service_type_id === 2)
                    <div class="form-row">
                        <div class="form-group col-md-4 required">
                            <label for="hostingSubTotal" class="col-form-label text-right text-gray-900">Hosting Fee</label>
                            <input type="number" name="hosting_invoice_item_subtotal" class="form-control @error('hosting_invoice_item_subtotal') is-invalid @enderror" id="hostingSubTotal" placeholder="Hosting Fee" value="@php foreach($invoiceInfo->invoiceItems as $item){ if($item->service_type_id == 2) {echo $item->invoice_item_subtotal; }} @endphp" required>
                            @error('hosting_invoice_item_subtotal')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 required">
                            <label for="hostingDiscount" class="col-form-label text-right text-gray-900">Hosting Discount</label>
                            <input type="number" name="hosting_invoice_item_discount" class="form-control @error('hosting_invoice_item_discount') is-invalid @enderror" id="hostingDiscount" placeholder="Hosting Discount" value="@php foreach($invoiceInfo->invoiceItems as $item){ if($item->service_type_id == 2) {echo $item->invoice_item_discount; }} @endphp" required>
                            @error('hosting_invoice_item_discount')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 required">
                            <label for="hostingNetAmount" class="col-form-label text-right text-gray-900">Net Amount</label>
                            <input type="number" name="hosting_invoice_item_total" class="form-control @error('hosting_invoice_item_total') is-invalid @enderror" id="hostingNetAmount" placeholder="Net Amount" value="@php foreach($invoiceInfo->invoiceItems as $item){ if($item->service_type_id == 2) {echo $item->invoice_item_total; }} @endphp" required>
                            @error('hosting_invoice_item_total')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="hidden" name="service_type_id[]" value="{{$serviceItem->service_type_id}}">
                    </div>
                    @endif
                    @if($serviceItem->service_type_id === 3)
                    <div class="form-row">
                        <div class="form-group col-md-4 required">
                            <label for="othersSubTotal" class="col-form-label text-right text-gray-900">Others Fee</label>
                            <input type="number" name="other_invoice_item_subtotal" class="form-control @error('other_invoice_item_subtotal') is-invalid @enderror" id="othersSubTotal" placeholder="Others Fee" value="@php foreach($invoiceInfo->invoiceItems as $item){ if($item->service_type_id == 3) {echo $item->invoice_item_subtotal; }} @endphp" required>
                            @error('other_invoice_item_subtotal')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 required">
                            <label for="othersDiscount" class="col-form-label text-right text-gray-900">Others Discount</label>
                            <input type="number" name="other_invoice_item_discount" class="form-control @error('other_invoice_item_discount') is-invalid @enderror" id="othersDiscount" placeholder="Others Discount" value="@php foreach($invoiceInfo->invoiceItems as $item){ if($item->service_type_id == 3) {echo $item->invoice_item_discount; }} @endphp" required>
                            @error('other_invoice_item_discount')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 required">
                            <label for="othersNetAmount" class="col-form-label text-right text-gray-900">Net Amount</label>
                            <input type="number" name="other_invoice_item_total" class="form-control @error('other_invoice_item_total') is-invalid @enderror" id="othersNetAmount" placeholder="Net Amount" value="@php foreach($invoiceInfo->invoiceItems as $item){ if($item->service_type_id == 3) {echo $item->invoice_item_total; }} @endphp" required>
                            @error('other_invoice_item_total')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="hidden" name="service_type_id[]" value="{{$serviceItem->service_type_id}}">
                    </div>
                    @endif
                    @endforeach

                    <div class="form-row">
                        <div class="form-group col-md-12 required">
                            <label for="invoiceDetails" class="col-form-label text-right text-gray-900">Invoice Details Info</label>
                            <textarea name="invoice_item_details" class="form-control @error('invoice_item_details') is-invalid @enderror" id="invoiceDetails" rows="3" placeholder="Invoice Details Info" required>@php foreach($invoiceInfo->invoiceItems as $item){ if($item->service_type_id == 1) {echo $item->invoice_item_details; }} @endphp</textarea>
                            @error('invoice_item_details')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
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
            format: "dd-mm-yyyy",
            todayHighlight: true,
        });

        /*$('.bkash-info').hide();
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
        });*/
    });
</script>

{{-- @if($errors->has('bkash_mobile_number') || $errors->has('bkash_transaction_no'))
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
@endif --}}
@endsection