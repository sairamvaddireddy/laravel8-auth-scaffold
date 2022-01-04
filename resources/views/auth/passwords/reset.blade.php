
@extends('layouts.auth')

@section('content')
<div class="col-md-6 col-sm-12">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
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
                        <form class="user" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" 
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="email" aria-describedby="emailHelp"
                                    placeholder="Email Address"
                                    required
                                    value="{{ $email ??  old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" 
                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                    id="password" placeholder="Password"
                                    required autofocus>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" 
                                    class="form-control form-control-user"
                                    id="confirm-password" placeholder="Confirm Password"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Reset Password
                            </button>                          
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('password.request') }}">Go back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
