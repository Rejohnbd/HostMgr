@extends('layouts.master')

@section('title', 'User Profile')


@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'User Profile',
'activePage' => 'User Profile'
])
@endcomponent

@if(session('success'))
@include('partials.success-alert')
@endif

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update Password</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('update_password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label text-right text-gray-900">User Email</label>
                        <input class="form-control disable" value="{{ Auth::user()->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="userOldPassword" class="col-form-label text-right text-gray-900">Old Password</label>
                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="userOldPassword" placeholder="Enter Old Password" required />
                        @error('old_password')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="userNewPassword" class="col-form-label text-right text-gray-900">New Password</label>
                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="userNewPassword" placeholder="Enter New Password" required />
                        @error('new_password')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="userConfirmNewPassword" class="col-form-label text-right text-gray-900">Confirm New Password</label>
                        <input type="password" name="confirm_new_password" class="form-control @error('confirm_new_password') is-invalid @enderror" id="userConfirmNewPassword" placeholder="Confirm New Password" required />
                        @error('confirm_new_password')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('dashboard') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection