@extends('layouts.master')

@section('title', 'Domain Reseller Details')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Domain Reseller Details',
'itemOne' => 'Domain Resellers',
'itemOneUrl' => 'domain-resellers.index',
'activePage' => 'Details'
])
@endcomponent

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Domain Reseller Info</h6>
                <a href="{{ route('domain-resellers.renew', $domainReseller->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Renew">
                    Renew
                </a>
            </div>
            <div class="card-body px-0 pb-0">
                <table class="table table-striped text-gray-900 mb-0">
                    <tbody>
                        <tr>
                            <th scope="row">Reseller Name</th>
                            <td>{{ $domainReseller->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Reseller Email</th>
                            <td>{{ $domainReseller->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Reseller Website</th>
                            <td>
                                <a href="{{ $domainReseller->website }}" target="_blank">
                                    {{ $domainReseller->website }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Create Date</th>
                            <td>{{ $domainReseller->created_at }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Update Date</th>
                            <td>{{ $domainReseller->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        @if($domainReseller->domainRenewLogs->count() > 0)
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Domain Reseller Last Renew Info</h6>
            </div>
            <div class="card-body px-0 pb-0">
                <table class="table table-striped text-gray-900 mb-0">
                    <tbody>
                        <tr>
                            <th scope="row">Last Renew date</th>
                            <td>{{ $domainReseller->domainRenewLogs->last()->domain_reseller_renew_date }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Last Renew Month</th>
                            <td>{{ $domainReseller->domainRenewLogs->last()->domain_reseller_renew_for }} Month</td>
                        </tr>
                        <tr>
                            <th scope="row">Last Expire Date</th>
                            <td>
                                {{ date('d-m-Y', $domainReseller->calculateExpireDate($domainReseller->domainRenewLogs->last()->domain_reseller_renew_date, $domainReseller->domainRenewLogs->last()->domain_reseller_renew_for))}}
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
                <h6 class="m-0 font-weight-bold text-primary">Domain Reseller Renew Log</h6>
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
                        @forelse($domainReseller->domainRenewLogs as $renewLog)
                        <tr>
                            <td>{{ $domainReseller->name }}</td>
                            <td>
                                {{ date('d-m-Y', strtotime($renewLog->domain_reseller_renew_date))}}
                            </td>
                            <td>{{ $renewLog->domain_reseller_renew_for }} Months</td>
                            <td>
                                {{ date('d-m-Y', $domainReseller->calculateExpireDate($renewLog->domain_reseller_renew_date, $renewLog->domain_reseller_renew_for))}}
                            </td>
                            <td>{{ $renewLog->domain_reseller_renew_amount }}</td>
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