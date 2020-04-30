@extends('layouts.master')

@section('title', 'Domain Resellers')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Domain Resellers',
'activePage' => 'Domain Resellers'
])
@endcomponent

<div class="col-lg-12">
    <div class="d-flex justify-content-start">
        <a href="{{ route('domain-resellers.create') }}" class="btn btn-info mb-2">Add Reseller</a>
    </div>
</div>

@if(session('success'))
@include('partials.success-alert')
@endif

@if(session('warning'))
@include('partials.warning-alert')
@endif

<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Domain Reseller Table</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Expire Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Expire Date</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($resellers as $reseller)
                    <tr>
                        <td>{{ $reseller->name }}</td>
                        <td>{{ $reseller->email }}</td>
                        <td>{{ $reseller->website }}</td>
                        <td>
                            @if($reseller->domainRenewLogs->count() > 0)
                            {{ date('d-m-Y', $reseller->calculateExpireDate($reseller->domainRenewLogs->last()->domain_reseller_renew_date, $reseller->domainRenewLogs->last()->domain_reseller_renew_for))}}
                            @else
                            No Data Found
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('domain-resellers.show', $reseller->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Details">
                                <i class="fas fa-search-plus"></i>
                            </a>
                            <a href="{{ route('domain-resellers.edit', $reseller->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Edit">
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