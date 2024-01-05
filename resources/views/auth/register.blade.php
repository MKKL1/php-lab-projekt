@extends('auth.layout.base')

@section('content')
    <h3 class="mb-5">Register</h3>
    <form action="{{route('auth.register-user')}}" method="post">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @else
            @if(Session::has('fail'))
                <div class="alert alert-danger">
                    {{Session::get('fail')}}
                </div>
            @endif
        @endif
        @csrf
        <div class="form-outline mb-4">
            <input type="text" id="loginInput" name="login" value="{{old('name')}}" class="form-control form-control-lg"/>
            <label class="form-label" for="loginInput">Login</label>
            <span class="text-danger">@error('login'){{$message}}@enderror</span>
        </div>

        <div class="form-outline mb-4">
            <input type="email" id="emailInput" name="email" value="{{old('email')}}" class="form-control form-control-lg"/>
            <label class="form-label" for="emailInput">Email</label>
            <span class="text-danger">@error('email'){{$message}}@enderror</span>
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="passwordInput" name="password" value="{{old('password')}}" class="form-control form-control-lg"/>
            <label class="form-label" for="passwordInput">Password</label>
            <span class="text-danger">@error('password'){{$message}}@enderror</span>
        </div>

        <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>

    </form>

    <hr class="my-4">

    <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;"
            type="submit"><i class="fab fa-google me-2"></i> Sign in with google
    </button>
    <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;"
            type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook
    </button>
@endsection
