@extends('layouts.master')

@section('title', 'Services Expired')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Services Expired',
'activePage' => 'Services Expired'
])
@endcomponent


<div class="col-lg-12">
    <div class="card mb-4 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Services ExpiredTable</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Service</th>
                        <th>Domain</th>
                        <th>Start to Expire Date</th>
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
                        <td class="@if(strtotime($service->service_expire_date) < strtotime(date('Y-m-d'))) bg-danger @elseif(strtotime($service->service_expire_date) > strtotime(date('Y-m-d')))@php $monthDifferece = calculate_month_differents(date('Y-m-d'), $service->service_expire_date); if($monthDifferece <= 2){echo'bg-warning';}@endphp@endif">
                            {{ date('d/m/Y', strtotime($service->service_start_date)) }} to {{ date('d/m/Y', strtotime($service->service_expire_date)) }}
                        </td>
                        <td>
                            <a href=" {{ route('services.show', $service->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Service Details">
                                <i class="fas fa-search-plus"></i>
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