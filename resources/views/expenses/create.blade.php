@extends('layouts.master')

@if(isset($expenses))
@section('title', 'Domain Reseller Update')
@else
@section('title', 'Expenses Create')
@endif

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => isset($expenses) ? 'Expenses Update' : 'Expenses Create' ,
'itemOne' => 'Expenses',
'itemOneUrl' => 'expenses.index',
'activePage' => isset($expenses) ? 'Update' : 'Create'
])
@endcomponent

@if(session('success'))
@include('partials.success-alert')
@endif

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ isset($expenses) ? 'Update Expenses' : 'Create Expenses' }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ isset($expenses) ? route('expenses.update', [' id' => $expenses->id]) : route('expenses.store') }}" method="POST">
                    @csrf
                    @isset($expenses)
                    @method('PUT')
                    @endisset

                    <div class="form-group required">
                        <label for="domainResellerEmail" class="col-form-label text-right text-gray-900">Expenses Amount</label>
                        <input type="number" name="expenses_amount" class="form-control @error('expenses_amount') is-invalid @enderror" id="domainResellerEmail" placeholder="Expenses Amount" value="{{ isset($expenses) ? floor($expenses->expenses_amount) : old('expenses_amount') }}" required>
                        @error('expenses_amount')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required">
                        <label for="expensesDetails" class="col-form-label text-right text-gray-900">Expenses Details</label>
                        <textarea name="details" class="form-control @error('details') is-invalid @enderror" id="expensesDetails" rows="3" placeholder="Expenses Details" required>{{ isset($expenses) ? $expenses->details : old('details') }}</textarea>
                        @error('details')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">{{ isset($domainReseller) ? 'Update' : 'Save' }}</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('expenses.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection