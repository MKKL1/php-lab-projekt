@extends('auth.layout.base')

@section('content')
    <h3 class="mb-5">Sign in</h3>
    <div class="form-outline mb-4">
        <input type="email" id="typeEmailX-2" class="form-control form-control-lg"/>
        <label class="form-label" for="typeEmailX-2">Email</label>
    </div>

    <div class="form-outline mb-4">
        <input type="password" id="typePasswordX-2" class="form-control form-control-lg"/>
        <label class="form-label" for="typePasswordX-2">Password</label>
    </div>

    <!-- Checkbox -->
    <div class="form-check d-flex justify-content-start mb-4">
        <input class="form-check-input" type="checkbox" value="" id="form1Example3"/>
        <label class="form-check-label" for="form1Example3"> Remember password </label>
    </div>

    <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

    <hr class="my-4">

    <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;"
            type="submit"><i class="fab fa-google me-2"></i> Sign in with google
    </button>
    <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;"
            type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook
    </button>
@endsection
