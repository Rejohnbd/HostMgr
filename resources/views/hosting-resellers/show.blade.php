@extends('layouts.master')

@section('title', 'Hosting Reseller Details')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Hosting Reseller Details</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('hosting-resellers.index') }}">Hosting Resellers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Details</li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Hosting Reseller Info</h6>
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
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Hosting Reseller Renew Info</h6>
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
</div>
@endsection