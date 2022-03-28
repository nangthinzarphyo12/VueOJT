@extends('loginLayout')

@section('content')
    <form action="{{ route('password.email') }}" method="POST" class="form">
        @csrf
        <div class="form-content">
            <div class="main-title">
                <h2>Reset Password</h2>
                @if (session('status'))
                    <p id="successMessage" name="successMessage" class="successMessage">{{ session('status') }}</p>
                @endif
            </div>
            <div class="content">
                <label for="email">Email<span class="required-sign">*</span></label>
                <input type="text" id="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
            </div>
            @error('email')
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @enderror
            <div class="btn">
                <button type="submit" class="sub-btn reset-link-btn">Send Password Reset Link</button>
            </div>
        </div>
    </form>
@endsection
