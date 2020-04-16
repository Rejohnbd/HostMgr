@extends('layouts.master-login')

@section('title', 'Register')

@section('content')
<div class="card shadow-sm my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="login-form">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="emailAddress">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="emailAddress" placeholder="Enter Email Address" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mobileNumber">Mobile Number</label>
                            <input type="tel" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="mobileNumber" placeholder="Enter First Name" value="{{ old('mobile') }}" required>
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="passwordRepet">Repeat Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="passwordRepet" placeholder="Repeat Password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="font-weight-bold small" href="{{ url('/') }}">Already have an account?</a>
                    </div>
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection