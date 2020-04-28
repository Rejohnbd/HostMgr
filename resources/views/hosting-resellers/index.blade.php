@extends('layouts.master')

@section('title', 'Hosting Resellers')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Hosting Resellers',
'activePage' => 'Hosting Resellers'
])
@endcomponent

<div class="col-lg-12">
    <div class="d-flex justify-content-start">
        <a href="{{ route('hosting-resellers.create') }}" class="btn btn-info mb-2">Add Reseller</a>
    </div>
</div>

<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Hosting Reseller Table</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Renew Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Renew Date</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($resellers as $reseller)
                    <tr>
                        <td>{{ $reseller->name }}</td>
                        <td>{{ $reseller->email }}</td>
                        <td>{{ $reseller->website }}</td>
                        <td></td>
                        <td>
                            <a href="{{ route('hosting-resellers.show', $reseller->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Details">
                                <i class="fas fa-search-plus"></i>
                            </a>
                            <a href="{{ route('hosting-resellers.edit', $reseller->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Edit">
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