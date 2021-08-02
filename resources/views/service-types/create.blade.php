@extends('layouts.master')

@if(isset($serviceType))
@section('title', 'Update Service Type')
@else
@section('title', 'Create Service Type')
@endif

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => isset($serviceType) ? 'Update Service Type' : 'Create Service Type',
'itemOne' => 'Services Types',
'itemOneUrl' => 'service-types.index',
'activePage' => isset($serviceType) ? 'Update' : 'Create'
])
@endcomponent


@if(session('success'))
@include('partials.success-alert')
@endif

{{-- Show Warning Alert --}}
@if(session('warning'))
@include('partials.warning-alert')
@endif

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ isset($serviceType) ? 'Create Service Type' : 'Create Service Type'}}</h6>
            </div>
            <div class="card-body">
                <form action="{{ isset($serviceType) ? route('service-types.update', $serviceType->id) : route('service-types.store') }}" method="POST">
                    @csrf
                    @isset($serviceType)
                    @method('PUT')
                    @endisset
                    <div class="form-group required">
                        <label for="typeName" class="col-form-label text-right text-gray-900">Service Type Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="typeName" placeholder="Service Type Name" value="{{ isset($serviceType) ? $serviceType->name : old('name') }}" required>
                        @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required">
                        <label for="serviceTypeDetails" class="col-form-label text-right text-gray-900">Service Type Details</label>
                        <textarea name="details" class="form-control @error('details') is-invalid @enderror" id="serviceTypeDetails" rows="3" placeholder="Service Type Details" required>{{ isset($serviceType) ? $serviceType->details : old('details') }}</textarea>
                        @error('details')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">{{ isset($serviceType) ? 'Update' : 'Save'}}</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('service-types.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection