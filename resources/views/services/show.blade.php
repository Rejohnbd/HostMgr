@extends('layouts.master')

@section('title', 'Services Details')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Services Details',
'itemOne' => 'Services',
'itemOneUrl' => 'services.index',
'activePage' => 'Details'
])
@endcomponent

<div class="col-lg-12">
    <div class="card mb-4 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Services Details</h6>
        </div>
        <div class="card-body justify-content-center">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Details of : <a href="{{$service->domain_name }}" target="_blank"> {{$service->domain_name }}</a></h6>
                        </div>

                        <table class="table table-striped text-gray-900 mb-0">
                            <tbody>
                                @if($service->customer->customer_type === 'individual')
                                <tr>
                                    <th scope="row">First Name</th>
                                    <td>{{ $service->customer->customer_first_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Name </th>
                                    <td>{{ $service->customer->customer_last_name }}</td>
                                </tr>
                                @endif
                                @if($service->customer->customer_type === 'company')
                                <tr>
                                    <th scope="row">Company Name</th>
                                    <td>{{ $service->customer->company_name }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $service->customer->user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Service Type</th>
                                    <td>
                                        <button class="btn btn-info btn-sm">
                                            @if($service->service_for === 1)
                                            {{ 'Domain Hosting Both' }}
                                            @elseif($service->service_for === 2)
                                            {{ 'Only Hosting' }}
                                            @else
                                            {{ 'Only Domain' }}
                                            @endif
                                        </button>
                                    </td>
                                </tr>
                                @if($service->domainReseller)
                                <tr>
                                    <th scope="row">Domain Reseller</th>
                                    <td>
                                        <a href="{{ route('domain-resellers.show', $service->domainReseller->id) }}" class="btn btn-primary btn-sm">
                                            <span class="text">{{ $service->domainReseller->name }}</span>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @if($service->hostingReseller)
                                <tr>
                                    <th scope="row">Hosting Reseller</th>
                                    <td>
                                        <a href="{{ route('hosting-resellers.show', $service->hostingReseller->id) }}" class="btn btn-primary btn-sm">
                                            <span class="text">{{ $service->hostingReseller->name }}</span>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th scope="row">Hosting Type</th>
                                    <td>{{ isset($service->hosting_type) ? ucfirst($service->hosting_type) : 'Hosting Service Not Used.' }}</td>
                                </tr>
                                @if($service->hostingPackage)
                                <tr>
                                    <th scope="row">Hosting Package</th>
                                    <td>
                                        <a href="{{ route('hosting-packages.show', $service->hostingPackage->id) }}" class="btn btn-primary btn-sm">
                                            <span class="text">{{ $service->hostingPackage->name }}</span>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th scope="row">Service Start Date</th>
                                    <td>{{ $service->service_start_date }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Service Expire Date</th>
                                    <td>{{ $service->service_expire_date }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('customers.show', $service->customer->id) }}" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Customer Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-info btn-circle">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-success btn-circle ">
                                <i class="fas fa-thumbs-up"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>

                @if($service->hosting_space)
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Customer Package Info</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped text-gray-900 mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Space</th>
                                        <td>{{ $service->hosting_space }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Bandwidth</th>
                                        <td>{{ $service->hosting_bandwidth }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Database Qty</th>
                                        <td>{{ $service->hosting_db_qty }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email Qty</th>
                                        <td>{{ $service->hosting_emails_qty }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Subdomain Qty</th>
                                        <td>{{ $service->hosting_subdomain_qty }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">FTP Qty</th>
                                        <td>{{ $service->hosting_ftp_qty }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Park Domain Qty</th>
                                        <td>{{ $service->hosting_park_domain_qty }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Addon Domain Qty</th>
                                        <td>{{ $service->hosting_addon_domain_qty }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Services Log</h6>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Service Type</th>
                            <th>Start Date</th>
                            <th>Expire Date</th>
                            <th>Invoice</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($service->serviceLogs as $serviceLog)
                        <tr>
                            <td>{{ ucfirst($serviceLog->service_type) }}</td>
                            <td>{{ $serviceLog->service_start_date }}</td>
                            <td>{{ $serviceLog->service_expire_date }}</td>
                            <td>
                                @if($serviceLog->invoice_status === 0)
                                Invoice Not Ready
                                @endif
                                @if($serviceLog->invoice_status === 1)
                                Invoice Ready
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Reseller Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection