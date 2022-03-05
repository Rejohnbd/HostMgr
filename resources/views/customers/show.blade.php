@extends('layouts.master')

@section('title', 'Customer Details')

@section('content')

{{-- Breadcrumb Show --}}
@if($customer->customer_type === 'individual')
@component('partials.breadcrumb',[
'title' => 'Details of '. $customer->customer_first_name . ' ' . $customer->customer_last_name,
'itemOne' => 'Customers',
'itemOneUrl' => 'customers.index',
'activePage' => 'Customer Details'
])
@endcomponent
@endif

@if($customer->customer_type === 'company')
@component('partials.breadcrumb',[
'title' => 'Details of '. $customer->company_name,
'itemOne' => 'Customers',
'itemOneUrl' => 'customers.index',
'activePage' => 'Customer Details'
])
@endcomponent
@endif

<div class="row mb-4">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <nav class="nav-fill">
                    <div class="nav nav-tabs justify-content-between align-items-center" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="client-info-tab" data-toggle="tab" href="#client-info" role="tab" aria-controls="client-info" aria-selected="true">Customer Information</a>
                        <a class="nav-item nav-link" id="client-service-tab" data-toggle="tab" href="#client-service" role="tab" aria-controls="client-service" aria-selected="false">Customer Services <span class="badge badge-danger">{{ $customer->customerServices->count() }}</span></a>
                        <a class="nav-item nav-link" id="client-billing-tab" data-toggle="tab" href="#client-billing" role="tab" aria-controls="client-billing" aria-selected="false">Billing Information</a>
                    </div>
                </nav>
                <div class="tab-content mt-4" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="client-info" role="tabpanel" aria-labelledby="client-info-tab">
                        <div class="row">
                            <div class="col">
                                @if($customer->customer_type === 'individual')
                                @include('partials.individual-customer-info')
                                @endif
                                @if($customer->customer_type === 'company')
                                @include('partials.company-customer-info')
                                @endif
                            </div>
                            <div class="col">
                                @if($customer->customerContactPersons->count() > 0)
                                @include('partials.customer-contact-person')
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="client-service" role="tabpanel" aria-labelledby="client-servoce-tab">
                        <div class="row">
                            @forelse($customer->customerServices as $service)
                            @include('partials.customer-service-item')
                            @empty
                            <div class="card card-default">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">No Service Yet Now.</h6>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="tab-pane fade" id="client-billing" role="tabpanel" aria-labelledby="client-billing-tab">
                        <h1>Work Here Later</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection