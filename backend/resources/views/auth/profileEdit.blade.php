@extends('layout')

@section('content')
    <form action="{{ route('auth.profileUpdate') }}" method="POST" class="form">
        @csrf
        <div class="form-content">
            <div class="main-title">
                <h2>Edit Profile</h2>
            </div>
            <div class="content">
                <input type="hidden" name="id" id="id" placeholder="id" value="{{ $user->id }}">
            </div>
            <div class="content">
                <label for="name">Name<span class="required-sign">*</span></label>
                <input type="text" name="name" id="name" placeholder="name" @if ($errors->any())  value="{{old('name')}}" @else value="{{ $user->name }}" @endif>
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger">
                    <p>{{ $errors->first('name') }}</p>
                </div>
            @endif
            <div class="content">
                <label for="email">Email<span class="required-sign">*</span></label>
                <input type="text" name="email" id="email" placeholder="email" @if ($errors->any())  value="{{old('email')}}" @else value="{{ $user->email }}" @endif>
            </div>
            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    <p>{{ $errors->first('email') }}</p>
                </div>
            @endif
            <div class="content chk">
                <label for="adminRole">Admin</label>
                <input type="radio" name="role" id="adminRole" value="0" class="check" @if ($errors->any()) @if ($errors->any()) {{ old('role') == '0' ? 'checked' : '' }} @else @if ($post->public_flag == 1) checked @endif @endif  @else @if ($user->role == 'admin') checked @endif @endif>

                <label for="userRole">Member</label>
                <input type="radio" name="role" id="userRole" value="1" class="check" @if ($errors->any()) {{ old('role') == '1' ? 'checked' : '' }}  @else @if ($user->role == 'member') checked @endif @endif>

            </div>
            <div class="content">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="phone" @if ($errors->any())  value="{{old('phone')}}" @else value="{{ $user->phone }}" @endif>
            </div>
            <div class="btn">
                <a class="sub-btn" href="{{ route('auth.profileDetail', $user->id) }}">Back</a>
                <button type="submit" class="sub-btn">Update</button>
            </div>
        </div>
    </form>

@endsection
