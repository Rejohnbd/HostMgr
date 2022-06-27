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


@if(session('success'))
@include('partials.success-alert')
@endif

{{-- Show Warning Alert --}}
@if(session('warning'))
@include('partials.warning-alert')
@endif

<?php
if (strtotime($service->service_expire_date) <= strtotime(date('Y-m-d'))) {
?>
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            This Service Cross the Expire date.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <?php
} elseif (strtotime($service->service_expire_date) > strtotime(date('Y-m-d'))) {
    $monthDifferece = calculate_month_differents(date('Y-m-d'), $service->service_expire_date);
    if ($monthDifferece <= 2) {
    ?>
        <div class="col-lg-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                This service will expire soon.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
<?php
    }
}
?>

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
                            <h6 class="m-0 font-weight-bold text-primary">Details of : {{$service->domain_name }}</h6>
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
                                        <a href="{{ route('hosting-packages.index') }}" class="btn btn-primary btn-sm">
                                            <span class="text">{{ $service->hostingPackage->name }}</span>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th scope="row">Service Start Date</th>
                                    <td>{{ date('d/m/Y', strtotime($service->service_start_date)) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Service Expire Date</th>
                                    <td>{{ date('d/m/Y', strtotime($service->service_expire_date)) }}</td>
                                </tr>
                                @if(!empty($service->cpanel_username))
                                <tr>
                                    <th scope="row">Cpanel Username</th>
                                    <td>
                                        <span id="cpanelUserName">{{ $service->cpanel_username }}</span>
                                        <button onclick="copyFunction('cpanelUserName');return false;" class="btn btn-info btn-sm float-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Copy Cpanel Username">
                                            <i class="far fa-copy"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endif
                                @if(!empty($service->cpanel_password))
                                <tr>
                                    <th scope="row">Cpanel Password</th>
                                    <td>
                                        <span id="cpanelPass">{{ $service->cpanel_password }}</span>
                                        <button onclick="copyFunction('cpanelPass');return false;" class="btn btn-info btn-sm float-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Copy Cpanel Password">
                                            <i class="far fa-copy"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('customers.show', $service->customer->id) }}" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Customer Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($service->invoice_status === 0)
                            <a href="{{ route('invoices.create', $service->id) }}" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="top" title="Create Invoice">
                                <i class="fas fa-file-signature"></i>
                            </a>
                            @endif
                            @if($service->invoice_status === 1 && $service->payment_status === 0)
                            <button class="btn btn-success btn-circle btnPaymentFirst" data-toggle="tooltip" data-placement="top" title="Renew Services">
                                <i class="fas fa-handshake"></i>
                            </button>
                            @endif
                            @if($service->invoice_status === 1 && $service->payment_status === 1)
                            <a href="{{ route('services.renew', $service->id) }}" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="Renew Services">
                                <i class="fas fa-handshake"></i>
                            </a>
                            @endif
                            {{-- <a href="#" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="top" title="Deactive This Service">
                                <i class="fas fa-thumbs-down"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                            </a> --}}
                        </div>
                    </div>
                </div>

                @if($service->serviceItems )
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Service Types Info</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped text-gray-900 mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Service Type</th>
                                        <td>
                                            @foreach($service->serviceItems as $serviceItem)
                                            @if($serviceItem->service_type_id === 1)
                                            <button class="btn btn-info btn-sm">{{ 'Domain' }}</button>
                                            @endif
                                            @if($serviceItem->service_type_id === 2)
                                            <button class="btn btn-primary btn-sm">{{ 'Hosting' }}</button>
                                            @endif
                                            @if($serviceItem->service_type_id === 3)
                                            <button class="btn btn-warning btn-sm">{{ 'Others' }}</button>
                                            @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Service Item Details</th>
                                        <td>
                                            {{ $service->serviceItems->first()->item_details }}
                                        </td>
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
    @if($service->hosting_type === 'custom')
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Customer Hosting Package Info</h6>
        </div>
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
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
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <table class="table table-striped text-gray-900 mb-0">
                        <tbody>
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
    </div>
    @endif
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
                            <th>Service For</th>
                            <th>Service Type</th>
                            <th>Start Date</th>
                            <th>Expire Date</th>
                            <th>Invoice No</th>
                            <th>Invoice</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($service->serviceLogs as $serviceLog)
                        <tr>
                            <td>{{ ucfirst($serviceLog->service_log_for) }}</td>
                            <td>
                                @php
                                $serviceTypeIds = explode (",", $serviceLog->service_type_ids);
                                foreach($serviceTypeIds as $id){
                                @endphp
                                <span class="badge badge-primary">{{ $service->findServiceTypeNameFromId($id) }}</span>
                                @php
                                }
                                @endphp
                            </td>
                            <td>{{ date('d/m/Y', strtotime($serviceLog->service_start_date)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($serviceLog->service_expire_date)) }}</td>
                            <td>{{ $serviceLog->invoice_number }}</td>
                            <td>
                                @if($serviceLog->invoice_status == 0)
                                Invoice Not Ready
                                @endif
                                @if($serviceLog->invoice_status == 1)
                                <a href="{{ route('invoices.download', $serviceLog->invoice_number) }}" target="_blank" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Downlad Invoice No {{ $serviceLog->invoice_number }}">
                                    <i class="fas fa-file-download"></i>
                                </a>
                                @if($service->checkServicePaymentSatusbyInvoiceNumber($serviceLog->invoice_number) != 1)
                                <a href="{{ route('payment-invoice', $serviceLog->invoice_number) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Payment for Invoice No {{ $serviceLog->invoice_number }}">
                                    <i class="fas fa-money-bill"></i>
                                </a>
                                @endif
                                @endif
                                @if($serviceLog->invoice_status == 1 && (strtotime(date('Y-m-d')) == strtotime(date('Y-m-d', strtotime($serviceLog->created_at)))))
                                <a href="{{ route('invoices.renew', $serviceLog->invoice_number) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Invoice No {{ $serviceLog->invoice_number }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif
                            </td>
                            <td>
                                @if($serviceLog->invoice_status == 1)
                                @if($service->checkServicePaymentSatusbyInvoiceNumber($serviceLog->invoice_number) == 0)
                                Unpaid
                                @elseif($service->checkServicePaymentSatusbyInvoiceNumber($serviceLog->invoice_number) == 1 )
                                Paid
                                @else
                                Partial Paid
                                @endif
                                @else
                                Unpaid
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="payFirstModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cannot Renew Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Pay your previous due first</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.btnPaymentFirst').on('click', function() {
            $('#payFirstModal').modal('show');
        })
    })

    function copyFunction(id) {
        var r = document.createRange();
        r.selectNode(document.getElementById(id));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(r);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
    }
</script>
@endsection