@extends('layouts.master-login')

@section('title', 'Login')

@section('content')
<div class="card shadow-sm my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="login-form">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                <input type="checkbox" class="custom-control-input" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="font-weight-bold small" href="{{ url('/register') }}">Create an Account!</a>
                    </div>
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection