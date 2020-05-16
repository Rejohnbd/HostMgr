@extends('layouts.master')

@section('title', 'Services')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Services',
'activePage' => 'Services'
])
@endcomponent

@if(session('success'))
@include('partials.success-alert')
@endif

@if(session('warning'))
@include('partials.warning-alert')
@endif

<div class="col-lg-12">
    <div class="d-flex justify-content-start">
        <a href="{{ route('services.create') }}" class="btn btn-info mb-2">Add Service</a>
    </div>
</div>

<div class="col-lg-12">
    <div class="card mb-4 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Services Table</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Service</th>
                        <th>Domain</th>
                        <th>Start Date</th>
                        <th>Expire Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>
                            @if($service->customer->customer_type === 'individual')
                            {{ $service->customer->customer_first_name }} {{ $service->customer->customer_last_name }}
                            @endif
                            @if($service->customer->customer_type === 'company')
                            {{ $service->customer->company_name }}
                            @endif
                        </td>
                        <td>{{ $service->customer->user->email }}</td>
                        <td>
                            @if($service->service_for === 1)
                            {{ 'Domain Hosting Both' }}
                            @elseif($service->service_for === 2)
                            {{ 'Only Hosting' }}
                            @else
                            {{ 'Only Domain' }}
                            @endif
                        </td>
                        <td>{{ $service->domain_name }}</td>
                        <td>{{ $service->service_start_date }}</td>
                        <td>{{ $service->service_expire_date }}</td>
                        <td>
                            <a href="{{ route('services.show', $service->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Service Details">
                                <i class="fas fa-search-plus"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Service Edit">
                                <i class="far fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No Data Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection