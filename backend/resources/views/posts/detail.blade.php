@extends('layout')

@section('content')
    <div class="form">
        <div class="form-content">
            <div class="main-title">
                <h2>Post Detail</h2>
                @if ($message = Session::get('success'))
                    <p id="successMessage" name="successMessage" class="successMessage">{{ $message }}</p>
                @endif
            </div>
            <div class="post-card">
                <div class="post-head">
                    <h4>{{ $post->title }}
                        @if ($post->public_flag == 1) <label>
                                <i class="fa fa-globe awesome-icon"></i>
                            </label> @endif
                        @if ($post->public_flag == 0) <label><i class="fa fa-lock awesome-icon"></i></label> @endif
                    </h4>
                    <p>Last updated on {{ $post->updated_at }}</p>
                    <p>{{ $post->name }}</p>
                </div>
                <div class="post-body">
                    <p class="description-text">{{ $post->description }}</p>
                    <div class="comment-box">
                        <div class="comment-body">
                        @foreach ($commentDetails as $comment)
                        <div class="comment-text">
                        <div class="comment-content">
                            <p class="comment-author">{{ $comment->user->name }} : </p>
                            <p class="comment">{{ $comment->comment_text }}</p></div>
                            <p>{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        @endforeach
                        </div>
                    </div>
                    <form action="{{ route('posts.comment', $post->id) }}" method="POST" class="search-form">
                        @csrf
                        <div class="search-info">
                            <textarea type="text" name="comment_text" id="comment_text" placeholder="Type your comment here ..."
                                class="description-area" rows="2"></textarea>
                            <button type="submit" class="sub-btn">Submit</button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                    </form>
                    <div class="btn">
                        <a class="sub-btn" href="{{ route('postList') }}">Back</a>
                        @if (Auth::check())
                            @if (Auth::user()->role == 'member')
                                @if (Auth::user()->id == $post->created_by)
                                    <a class="sub-btn" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                @endif
                            @else
                                <a class="sub-btn" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
