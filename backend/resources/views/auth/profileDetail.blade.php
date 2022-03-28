@extends('layout')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" class="form">
        @csrf
        <div class="form-content detail-page">
            <div class="main-title">
                <h2>Profile Detail</h2>
                @if ($message = Session::get('success'))
                    <p id="successMessage" name="successMessage" class="successMessage">{{ $message }}</p>
                @endif
            </div>
            <div class="content">
                <input type="hidden" name="id" id="id" placeholder="id" value="{{ $user->id }}">
            </div>
            <div class="content">
                <label for="name">Name<span class="required-sign">*</span></label>
                <input type="text" name="name" id="name" placeholder="name" value="{{ $user->name }}" readonly>
            </div>
            <div class="content">
                <label for="email">Email<span class="required-sign">*</span></label>
                <input type="email" name="email" id="email" placeholder="email" value="{{ $user->email }}" readonly>
            </div>
            @if (Auth::check())
                @if (Auth::user()->role == 'member')
                    @if (Auth::user()->id == $user->id)
                        <div class="content change-pwd-btn">
                            <label for="password">Password</label>
                            <a class="sub-btn" href="{{ route('auth.passwordEdit', $user->id) }}">Edit</a>
                        </div>
                    @endif
                @else
                    <div class="content change-pwd-btn">
                        <label for="password">Password</label>
                        <a class="sub-btn" href="{{ route('auth.passwordEdit', $user->id) }}">Edit</a>
                    </div>
                @endif
            @endif
            @if ($user->role == 'admin')
                <label for="adminRole"><i class="fa fa-user awesome-icon"></i>Admin</label>
            @endif
            @if ($user->role == 'member')
                <label for="memberRole"><i class="fa fa-user awesome-icon"></i>Member</label>
            @endif
            <div class="content">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="phone" value="{{ $user->phone }}" readonly>
            </div>
            <div class="btn">
                <a class="sub-btn" href="{{ route('postList') }}">Back</a>
                @if (Auth::check())
                    @if (Auth::user()->role == 'member')
                        @if (Auth::user()->id == $user->id)
                            <a class="sub-btn" href="{{ route('auth.profileEdit', $user->id) }}">Edit</a>
                        @endif
                    @else
                        <a class="sub-btn" href="{{ route('auth.profileEdit', $user->id) }}">Edit</a>
                    @endif
                @endif
            </div>
        </div>
    </form>

@endsection
