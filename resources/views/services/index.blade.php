@extends('layouts.master')

@section('title', 'Services')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Services</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Services</li>
    </ol>
</div>

@if(session('success'))
@include('partials.success-alert')
@endif

<div class="d-flex justify-content-end">
    <a href="{{ route('services.create') }}" class="btn btn-info mb-2">Add Service</a>
</div>
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Services Table</h6>
        </div>
        <div class="table-responsive">
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
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Service</th>
                        <th>Domain</th>
                        <th>Start Date</th>
                        <th>Expire Date</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>{{ $service->customer->customer_first_name }} {{ $service->customer->customer_last_name }}</td>
                        <td>{{ $service->customer->user->email }}</td>
                        <td>
                            @if($service->service_for === '1')
                            {{ 'Domain Hosting Both' }}
                            @elseif($service->service_for === '2')
                            {{ 'Only Hosting' }}
                            @else
                            {{ 'Only Domain' }}
                            @endif
                        </td>
                        <td>{{ $service->domain_name }}</td>
                        <td>{{ $service->service_start_date }}</td>
                        <td>{{ $service->service_expire_date }}</td>
                        <td>
                            <a href="" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Details">
                                <i class="fas fa-search-plus"></i>
                            </a>
                            <a href="" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Edit">
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