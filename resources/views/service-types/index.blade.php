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

{{-- Show Success Alert --}}
@if(session('success'))
@include('partials.success-alert')
@endif

{{-- Show Warning Alert --}}
@if(session('warning'))
@include('partials.warning-alert')
@endif

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
                                    <a class="dropdown-item text-info" href="{{ route('service-types.edit', $serviceType->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                    <button class="dropdown-item text-danger btn-delete" data-id="{{ $serviceType->id }}"><i class="fas fa-trash"></i> Delete</button>
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

<form action="{{ route('service-types-destroy') }}" method="POST" id="deleteForm">
    @csrf
    <div class="modal fade" id="listDeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal">Delete Service Types</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <p class="text-center text-bold">
                        Are you Sure? You want to delete this Service Type.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function() {
            var dataId = $(this).data("id");
            $('#listDeleteModal').modal('show');
            $('#id').val(dataId);
        })
    })
</script>
@endsection