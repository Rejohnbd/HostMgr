@extends('layouts.master')

@section('title', 'Customer Details')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customer Details</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Customer Details</li>
    </ol>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <nav class="nav-fill">
                    <div class="nav nav-tabs justify-content-between align-items-center" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="client-info-tab" data-toggle="tab" href="#client-info" role="tab" aria-controls="client-info" aria-selected="true">Customer Information</a>
                        <a class="nav-item nav-link" id="client-service-tab" data-toggle="tab" href="#client-service" role="tab" aria-controls="client-service" aria-selected="false">Customer Services</a>
                        <a class="nav-item nav-link" id="client-billing-tab" data-toggle="tab" href="#client-billing" role="tab" aria-controls="client-billing" aria-selected="false">Billing Information</a>
                    </div>
                </nav>
                <div class="tab-content mt-4" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="client-info" role="tabpanel" aria-labelledby="client-info-tab">
                        <div class="row">
                            <div class="col">
                                @include('partials.customer-information')
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
                            {{-- @foreach($customer->services as $service)
                            @include('partials.customer-service-item')
                            @endforeach --}}
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