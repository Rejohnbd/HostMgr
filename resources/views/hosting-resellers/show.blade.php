@extends('layouts.master')

@section('title', 'Hosting Reseller Details')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Hosting Reseller Details',
'itemOne' => 'Hosting Resellers',
'itemOneUrl' => 'hosting-resellers.index',
'activePage' => 'Details'
])
@endcomponent

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Hosting Reseller Info</h6>
                <a href="{{ route('hosting-resellers.renew', $hostingReseller->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Renew">
                    Renew
                </a>
            </div>
            <div class="card-body px-0 pb-0">
                <table class="table table-striped text-gray-900 mb-0">
                    <tbody>
                        <tr>
                            <th scope="row">Reseller Name</th>
                            <td>{{ $hostingReseller->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Reseller Email</th>
                            <td>{{ $hostingReseller->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Reseller Website</th>
                            <td>
                                <a href="{{ $hostingReseller->website }}" target="_blank">
                                    {{ $hostingReseller->website }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Create Date</th>
                            <td>{{ $hostingReseller->created_at }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Update Date</th>
                            <td>{{ $hostingReseller->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        @if($hostingReseller->hostingRenewLogs->count() > 0)
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Domain Reseller Last Renew Info</h6>
            </div>
            <div class="card-body px-0 pb-0">
                <table class="table table-striped text-gray-900 mb-0">
                    <tbody>
                        <tr>
                            <th scope="row">Last Renew date</th>
                            <td>{{ $hostingReseller->hostingRenewLogs->last()->hosting_reseller_renew_date }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Last Renew Month</th>
                            <td>{{ $hostingReseller->hostingRenewLogs->last()->hosting_reseller_renew_for }} Month</td>
                        </tr>
                        <tr>
                            <th scope="row">Last Expire Date</th>
                            <td>
                                {{ date('d-m-Y', $hostingReseller->calculateExpireDate($hostingReseller->hostingRenewLogs->last()->hosting_reseller_renew_date, $hostingReseller->hostingRenewLogs->last()->hosting_reseller_renew_for))}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Hosting Reseller Renew Log</h6>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Reseller Name</th>
                            <th>Renew Date</th>
                            <th>Renew For</th>
                            <th>Expire Date</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Reseller Name</th>
                            <th>Renew Date</th>
                            <th>Renew For</th>
                            <th>Expire Date</th>
                            <th>Amount</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($hostingReseller->hostingRenewLogs as $renewLog)
                        <tr>
                            <td>{{ $hostingReseller->name }}</td>
                            <td>
                                {{ date('d-m-Y', strtotime($renewLog->hosting_reseller_renew_date))}}
                            </td>
                            <td>{{ $renewLog->hosting_reseller_renew_for }} Months</td>
                            <td>
                                {{ date('d-m-Y', $hostingReseller->calculateExpireDate($renewLog->hosting_reseller_renew_date, $renewLog->hosting_reseller_renew_for))}}
                            </td>
                            <td>{{ $renewLog->hosting_reseller_renew_amount }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>No Renew Log</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection