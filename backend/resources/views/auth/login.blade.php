@extends('loginLayout')

@section('content')
    <form action="{{ route('login') }}" method="POST" class="form">
        @csrf
        <div class="form-content">
            <div class="main-title">
                <h2>Login</h2>
            </div>
            <div class="content">
                <label for="email">Email<span class="required-sign">*</span></label>
                <input type="text" id="email" name="email" autocomplete="email" autofocus>
            </div>
            @error('email')
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @enderror
            <div class="content">
                <label for="password">Password<span class="required-sign">*</span></label>
                <input id="password" type="password" name="password">
            </div>
            <div class="btn">
                <button type="submit" class="sub-btn">Login</button>
                <a class="a-hov" href="{{ route('password.request') }}">Forget Password?</a>
            </div>
        </div>
    </form>
@endsection
