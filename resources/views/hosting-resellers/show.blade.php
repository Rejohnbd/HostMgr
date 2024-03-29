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

@if(session('success'))
@include('partials.success-alert')
@endif

@if(session('warning'))
@include('partials.warning-alert')
@endif

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Hosting Reseller Info</h6>
                <a href="{{ route('hosting-reseller.renew', $hostingReseller->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Renew">
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
                            <td>{{ date('d/m/Y', strtotime($hostingReseller->hostingRenewLogs->last()->hosting_reseller_renew_date)) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Last Renew Month</th>
                            <td>{{ $hostingReseller->hostingRenewLogs->last()->hosting_reseller_renew_for }} Month</td>
                        </tr>
                        <tr>
                            <th scope="row">Last Expire Date</th>
                            <td>
                                {{ date('d/m/Y', $hostingReseller->calculateExpireDate($hostingReseller->hostingRenewLogs->last()->hosting_reseller_renew_date, $hostingReseller->hostingRenewLogs->last()->hosting_reseller_renew_for))}}
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hostingReseller->hostingRenewLogs as $renewLog)
                        <tr>
                            <td>{{ $hostingReseller->name }}</td>
                            <td>
                                {{ date('d/m/Y', strtotime($renewLog->hosting_reseller_renew_date))}}
                            </td>
                            <td>{{ $renewLog->hosting_reseller_renew_for }} Months</td>
                            <td>
                                {{ date('d/m/Y', $hostingReseller->calculateExpireDate($renewLog->hosting_reseller_renew_date, $renewLog->hosting_reseller_renew_for))}}
                            </td>
                            <td>{{ $renewLog->hosting_reseller_renew_amount }}</td>
                            <td>
                                @if($hostingReseller->hostingRenewLogs->last()->id === $renewLog->id)
                                <button class="btn btn-danger btn-sm" onclick="handleDelete( {{ $renewLog->id }} )" data-toggle="tooltip" data-placement="top" title="" data-original-title="Reseller Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>No Renew Log</td>
                            <td></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('hosting-reseller.destroy') }}" method="POST" id="deleteResellerLogForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Reseller</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-bold">Are you sure you want to delete?</p>
                        <input type="hidden" name="log_id" id="del_id">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                        <button type="submit" class="btn btn-danger">Yes Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteResellerLogForm')
            $('#del_id').val(id);
            $('#deleteModal').modal('show');
        }
    </script>
    @endsection