@extends('layouts.app')

@section('content')
    <section class="vh-100" style=" background: rgb(20,54,110); background: linear-gradient(120deg, rgb(58,12,225) 0%, rgb(8,139,232) 80%); ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-5">Sign in</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="email" id="emailInput" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"/>
                                    <label class="form-label" for="emailInput">Email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="passwordInput" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="current-password"/>
                                    <label class="form-label" for="passwordInput">Password</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-check d-flex justify-content-start mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

                                <hr class="my-4">

{{--                                <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;"--}}
{{--                                        type="submit"><i class="fab fa-google me-2"></i> Sign in with google--}}
{{--                                </button>--}}
{{--                                <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;"--}}
{{--                                        type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook--}}
{{--                                </button>--}}

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
