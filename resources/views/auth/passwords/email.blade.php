@extends('layouts.auth')

@section('content')
<div class="col-md-6 col-sm-12">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="user" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" 
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="email" aria-describedby="emailHelp"
                                    placeholder="Email Address"
                                    required
                                    value="{{ old('email') }}"
                                    autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div> 
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                {{ __('Send Password Reset Link') }}
                            </button>                          
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">Login instead</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
