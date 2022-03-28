@extends('layout')

@section('content')
    <form action="{{ route('users.store') }}" method="POST" class="form">
        @csrf
        <div class="form-content">
            <div class="main-title">
                <h2>Add New User</h2>
            </div>
            <div class="content">
                <label for="name">Name<span class="required-sign">*</span></label>
                <input type="text" name="name" id="name" value="{{old('name')}}" placeholder="name">
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger">
                    <p>{{ $errors->first('name') }}</p>
                </div>
            @endif
            <div class="content">
                <label for="email">Email<span class="required-sign">*</span></label>
                <input type="text" name="email" id="email" value="{{old('email')}}" placeholder="email">
            </div>
            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    <p>{{ $errors->first('email') }}</p>
                </div>
            @endif
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
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="confirmPassword"">
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
            <div class="content chk">
                <label for="adminRole">Admin</label>
                <input type="radio" name="role" id="adminRole" value="0" class="check" text="Admin" {{ old('role') != "1" ? 'checked' : '' }}>
                <label for="userRole">Member</label>
                <input type="radio" name="role" id="userRole" value="1" class="check" {{ old('role') == "1" ? 'checked' : '' }}>
            </div>
            <div class="content">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="{{old('phone')}}" placeholder="phone">
            </div>
            <div class="btn">
                <a class="sub-btn" href="{{ route('users.list') }}">Back</a>
                <button type="submit" class="sub-btn">Add</button>
            </div>
        </div>
    </form>
@endsection
