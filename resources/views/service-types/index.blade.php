@extends('layouts.master')

@section('title', 'Service Types')

@section('content')
{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Service Types',
'activePage' => 'Services Types'
])
@endcomponent

<div class="col-lg-12">
    <div class="d-flex justify-content-start">
        <a href="{{ route('service-types.create') }}" class="btn btn-info mb-2">Add Type</a>
    </div>
</div>

<div class="col-lg-12">
    <div class="card mb-4 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Services Table</h6>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($serviceTypes as $serviceType)
                <div class="col-md-4 col-sm-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $serviceType->name }}</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="serviceTyes-{{ $serviceType->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="serviceTyes-{{ $serviceType->id }}" x-placement="bottom-end">
                                    <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $serviceType->details }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">No Service Create Yet</h6>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection