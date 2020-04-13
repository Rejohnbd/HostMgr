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
                    <form>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="exampleInputLastName" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Repeat Password</label>
                            <input type="password" class="form-control" id="exampleInputPasswordRepeat" placeholder="Repeat Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="font-weight-bold small" href="{{ url('/login') }}">Already have an account?</a>
                    </div>
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection