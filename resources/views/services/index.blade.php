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
            <div class="form-inline">

                <div class="form-group mr-2">
                    <select class="form-control" id="selectCustomer" style="width: 250px">
                        <option selected>Select Customer</option>
                        <option value="all">All</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">
                            @if($customer->customer_type === 'individual')
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                            @endif
                            @if($customer->customer_type === 'company')
                            {{ $customer->company_name }}
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-2">
                    <input type="email" class="form-control" id="expireDateFrom" placeholder="Expire Date From">
                </div>
                <div class="form-group mr-2">
                    <input type="email" class="form-control" id="expireDateTo" placeholder="Expire Date To">
                </div>
                <button class="btn btn-info" id="filterSearch">Search</button>
            </div>
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
                        <th>Invoice/Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="filterServiceReport">
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
                            @foreach($service->serviceItems as $serviceItem)
                            @if($serviceItem->service_type_id === 1)
                            {{ ' Domain ' }}
                            @endif
                            @if($serviceItem->service_type_id === 2)
                            {{ ' Hosting ' }}
                            @endif
                            @if($serviceItem->service_type_id === 3)
                            {{ ' Others ' }}
                            @endif
                            @endforeach
                        </td>
                        <td>{{ $service->domain_name }} </td>
                        <td class="@if(strtotime($service->service_expire_date) <= strtotime(date('Y-m-d'))) bg-danger @elseif(strtotime($service->service_expire_date) > strtotime(date('Y-m-d')))@php $monthDifferece = calculate_month_differents(date('Y-m-d'), $service->service_expire_date); if($monthDifferece <= 2){echo'bg-warning';}@endphp@endif">
                            {{ date('d/m/Y', strtotime($service->service_start_date)) }}
                        </td>
                        <td class="@if(strtotime($service->service_expire_date) <= strtotime(date('Y-m-d'))) bg-danger @elseif(strtotime($service->service_expire_date) > strtotime(date('Y-m-d')))@php $monthDifferece = calculate_month_differents(date('Y-m-d'), $service->service_expire_date); if($monthDifferece <= 2){echo'bg-warning';}@endphp@endif">
                            {{ date('d/m/Y', strtotime($service->service_expire_date)) }}
                        </td>
                        <td>
                            <button class="btn btn-sm @if($service->invoice_status)btn-success @else btn-danger @endif">@if($service->invoice_status) Ready @else Not Ready @endif</button>
                            <button class="btn btn-sm @if($service->payment_status == 1) btn-success @elseif($service->payment_status == 2) btn-warning @else btn-danger @endif">@if($service->payment_status == 1) Paid @elseif($service->payment_status == 2) Partial Paid @else Not Paid @endif</button>
                        </td>
                        <td>
                            <a href="{{ route('services.show', $service->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Service Details">
                                <i class="fas fa-search-plus"></i>
                            </a>
                            @if($service->invoice_status === 0)
                            <a href="{{ route('services.edit', $service->id) }}" class="mt-1 btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Service {{ $service->domain_name }}">
                                <i class="fas fa-pen"></i>
                            </a>
                            @endif
                            @if($serviceItem->service_type_id === 2)
                            <button class="mt-1 btn btn-success btn-sm editHostingInfo" data-id="{{ $service->id }}" data-name="{{ $service->domain_name }}" data-toggle="tooltip" data-placement="top" title="Edit Hosting Access Info">
                                <i class="fas fa-wrench"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="7">No Data Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="hostingInfoUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Hosing Info of <span class="text-info" id="serviceName"></span></h5>
                <button type="button" class="close modalClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="serviceId" value="" />
                <div class="form-group">
                    <label for="cpanelUserName">Cpanel Username</label>
                    <input type="text" class="form-control" id="cpanelUserName" value="" placeholder="Enter Cpanel Username">
                </div>
                <div class="form-group">
                    <label for="cpanelPassword">Cpanel Password</label>
                    <input type="text" class="form-control" id="cpanelPassword" value="" placeholder="Enter Cpanel Password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modalClose" data-dismiss="modal">Close</button>
                <button type="button" id="hostingInfoUpdate" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .select2-container--default .select2-selection--single {
        height: 41px !important;
        overflow: auto !important;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#selectCustomer").select2();
        $("#expireDateFrom").datepicker({
            format: "dd-mm-yyyy",
            todayHighlight: true,
        });

        $("#expireDateTo").datepicker({
            format: "dd-mm-yyyy",
            todayHighlight: true,
        });

        let selectCustomer = null;
        let expireDateFrom = null;
        let expireDateTo = null;

        $('#selectCustomer').on('change', function() {
            selectCustomer = this.value;
        })

        $(document).on('click', '#filterSearch', function(e) {
            $('#selectCustomer').removeClass('is-invalid');
            $('#expireDateFrom').removeClass('is-invalid');
            $('#expireDateTo').removeClass('is-invalid');

            if (selectCustomer == null) {
                alert('Please select Customer');
            } else if (!$('#expireDateFrom').val()) {
                $('#expireDateFrom').addClass('is-invalid');
            } else if (!$('#expireDateTo').val()) {
                $('#expireDateTo').addClass('is-invalid');
            } else {
                let expireDateFrom = $('#expireDateFrom').val();
                let expireDateTo = $('#expireDateTo').val();

                $.ajax({
                    url: "{{ route('services-filter') }}",
                    method: 'POST',
                    data: {
                        selectCustomer: selectCustomer,
                        expireDateFrom: expireDateFrom,
                        expireDateTo: expireDateTo,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        $('#filterServiceReport').html(response);
                    }
                })
            }
        })

        $('.editHostingInfo').click(function() {
            let dataId = $(this).data("id");
            let dataServiceName = $(this).data("name");
            $.ajax({
                url: "{{ route('services-hosting-info') }}",
                method: 'POST',
                data: {
                    serviceId: dataId,
                    _token: '{{csrf_token()}}',
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#serviceName').text(dataServiceName);
                        $('#serviceId').val(dataId);
                        $('#cpanelUserName').val(response.data.cpanel_username);
                        $('#cpanelPassword').val(response.data.cpanel_password);
                        $('#hostingInfoUpdateModal').modal('show');
                    }
                }
            });
        });

        $('#hostingInfoUpdateModal').on('hidden.bs.modal', function() {
            $('#serviceName').empty();
            $('#serviceId').val('');
            $('#cpanelUserName').val('');
            $('#cpanelPassword').val('');
        });

        $(document).on('click', '#hostingInfoUpdate', function() {
            let serviceId = $('#serviceId').val();
            let cpanelUserName = $('#cpanelUserName').val();
            let cpanelPassword = $('#cpanelPassword').val();

            $('#cpanelUserName').removeClass('is-invalid');
            $('#cpanelPassword').removeClass('is-invalid');
            $('#expireDateTo').removeClass('is-invalid');

            if (!$('#cpanelUserName').val()) {
                $('#cpanelUserName').addClass('is-invalid');
            } else if (!$('#cpanelPassword').val()) {
                $('#cpanelPassword').addClass('is-invalid');
            } else {

                $.ajax({
                    url: "{{ route('services-hosting-info-update') }}",
                    method: 'POST',
                    data: {
                        serviceId: serviceId,
                        cpanelUserName: cpanelUserName,
                        cpanelPassword: cpanelPassword,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            $('#hostingInfoUpdateModal').modal('hide');
                            location.reload();
                        }
                    }
                });
            }
        })

    });
</script>
@endsection