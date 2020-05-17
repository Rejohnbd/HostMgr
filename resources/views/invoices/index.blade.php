@extends('layouts.master')

@section('title', 'Unread Invoices')

@section('content')

@component('partials.breadcrumb',[
'title' => 'Unread Invoices',
'activePage' => 'Unread Invoices'
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
    <div class="card mb-4 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Unread Invoice</h6>
        </div>

        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Domain</th>
                        <th>Service</th>
                        <th>Service Type</th>
                        <th>Start Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse($uncomplteInvoices as $uncomplteInvoice)
                    <tr>
                        <td>
                            @if($uncomplteInvoice->customer->customer_type === 'individual')
                            {{ $uncomplteInvoice->customer->customer_first_name }} {{ $uncomplteInvoice->customer->customer_last_name }}
                    @endif
                    </td>
                    <td>{{ $uncomplteInvoice->service->domain_name }}</td>
                    <td>
                        @if($uncomplteInvoice->service->service_for == 1)
                        <button class="btn btn-info btn-sm">{{ 'Domain and Hosting Both' }}</button>
                        @endif
                        @if($uncomplteInvoice->service->service_for == 2)
                        <button class="btn btn-success btn-sm">{{ 'Only Hosting' }}</button>
                        @endif
                        @if($uncomplteInvoice->service->service_for == 3)
                        <button class="btn btn-warning btn-sm">{{ 'Only Domain' }}</button>
                        @endif
                    </td>
                    <td>{{ ucfirst($uncomplteInvoice->service_type) }}</td>
                    <td>{{ $uncomplteInvoice->service_start_date }}</td>
                    <td>
                        <a href="{{ route('invoices.create', $uncomplteInvoice->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Crate Invoice">
                            <i class="fas fa-file-alt"></i>
                        </a>
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No Uncomplate Invoice</td>
                    </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection