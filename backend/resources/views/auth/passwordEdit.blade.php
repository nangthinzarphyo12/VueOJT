@extends('layout')

@section('content')
    
    <form action="{{ route('auth.passwordUpdate') }}" method="POST" class="form">
        @csrf
        <div class="form-content">
            <div class="main-title">
                <h2>Edit Password</h2>
            </div>
            <div class="content">
                <input type="hidden" name="id" id="id" placeholder="id" value="{{ $user->id }}">
            </div>
            <div class="content">
                <label for="password">Password<span class="required-sign">*</span></label>
                <input type="password" name="password" id="password" placeholder="password">
            </div>
            @if ($errors->has('password'))
                <div class="alert alert-danger">
                    <p>{{ $errors->first('password') }}</p>
                </div>
            @endif
            <div class="content">
                <label for="confirmPassword">Confirm Password<span class="required-sign">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="confirmPassword">
            </div>
            @if ($errors->has('confirmPassword'))
                <div class="alert alert-danger">
                    <p>{{ $errors->first('confirmPassword') }}</p>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="btn">
                <a class="sub-btn" href="{{ route('auth.profileDetail', $user->id) }}">Back</a>
                <button type="submit" class="sub-btn">Update</button>
            </div>
        </div>
    </form>

@endsection
