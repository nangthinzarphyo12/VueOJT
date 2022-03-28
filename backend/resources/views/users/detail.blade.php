@extends('layout')

@section('content')
    <form method="POST" class="form">
        @csrf
        <div class="form-content detail-page">
            <div class="main-title">
                <h2>User Detail</h2>
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
                <a class="sub-btn" href="{{ route('users.list') }}">Back</a>
                @if (Auth::check())
                    @if (Auth::user()->role == 'member')
                        @if (Auth::user()->id == $user->id)
                            <a class="sub-btn" href="{{ route('users.edit', $user->id) }}">Edit</a>
                        @endif
                    @else
                        <a class="sub-btn" href="{{ route('users.edit', $user->id) }}">Edit</a>
                    @endif
                @endif
            </div>
        </div>
    </form>

    <div class="form">
        <div class="form-content">
            <div class="main-title">
                <h2>Comment Detail</h2>
            </div>
            <table class="user-table">
                <tr>
                    <th width="10%">No.</th>
                    <th width="20%">Post</th>
                    <th width="70%">Comment</th>
                </tr>
                @if (count($comments) == 0)
                    <tr>
                        <td colspan="5">
                            <p class="no-data-alert">No Comment !</p>
                        </td>
                    </tr>
                @endif
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $comment->post_id }}</td>
                        <td>{{ $comment->comment_text }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection
