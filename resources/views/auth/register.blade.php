@extends('layouts.app')

@section('content')
    <section class="vh-100" style=" background: rgb(20,54,110); background: linear-gradient(120deg, rgb(58,12,225) 0%, rgb(8,139,232) 80%); ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-5">Register</h3>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-outline mb-4">
                                    <input type="text"
                                           id="nameInput"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           autocomplete="name"
                                           pattern="^(?=.*[A-Za-z0-9]$)[A-Za-z][A-Za-z\d.-]{0,19}$"/>
                                    <label class="form-label" for="nameInput">Nazwa</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email"
                                           id="emailInput"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           autocomplete="email"/>
                                    <label class="form-label" for="emailInput">Email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password"
                                           id="passwordInput"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password"
                                           value="{{ old('password') }}"
                                           required
                                           maxlength="25"
                                           autocomplete="new-password"/>
                                    <label class="form-label" for="passwordInput">Hasło</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-outline mb-4">
                                    <input type="password"
                                           id="passwordConfirmInput"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation"
                                           required
                                           maxlength="25"
                                           autocomplete="new-password"/>
                                    <label class="form-label" for="passwordConfirmInput">Potwierdź hasło</label>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Rejestracja</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
