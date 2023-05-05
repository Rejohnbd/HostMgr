@extends('layouts.master')

@section('title', 'Payment')

@section('content')

@component('partials.breadcrumb',[
'title' => 'Payment List',
'activePage' => 'Payment'
])
@endcomponent

@if(session('success'))
@include('partials.success-alert')
@endif

{{-- Show Warning Alert --}}
@if(session('warning'))
@include('partials.warning-alert')
@endif

<div class="col-lg-12">
    <h5><b>Current Balance:</b> {{ number_format(check_current_balance(),2)  }}</h5>
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Payment Table</h6>
        </div>

        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Domain</th>
                        <th>Invoice No</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Payment</th>
                        <th>Payment Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->findCustomerNameByUserId($payment->user_id) }}</td>
                        <td>{{ $payment->service->domain_name }}</td>
                        <td>{{ $payment->invoice->invoice_number }}</td>
                        <td>{{ $payment->invoice->invoice_total }}</td>
                        <td>{{ $payment->paid_amount }}</td>
                        <td>{{ ucfirst($payment->payment_method) }}</td>
                        <td>{{ date('d/m/Y', strtotime($payment->payment_date)) }}</td>
                        <td>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Payment Create Yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection