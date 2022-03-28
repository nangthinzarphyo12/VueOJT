@extends('layout')

@section('content')
    <form action="{{ route('posts.update') }}" method="POST" class="form">
        @csrf
        <div class="form-content">
            <div class="main-title">
                <h2>Edit Post</h2>
            </div>
            <div class="content">
                <input type="hidden" name="id" id="id" placeholder="id" value="{{ $post->id }}">
            </div>
            <div class="content">
                <label for="title">Title<span class="required-sign">*</span></label>
                <input type="text" name="title" id="title" placeholder="title" @if ($errors->any())  value="{{old('title')}}" @else value="{{ $post->title }}" @endif>
            </div>
            @if ($errors->has('title'))
                <div class="alert alert-danger">
                    <p>{{ $errors->first('title') }}</p>
                </div>
            @endif
            <div class="content">
                <label for="description">Description<span class="required-sign">*</span></label>
                <textarea type="text" name="description" id="description" placeholder="description" class="description-area" rows="6">@if ($errors->any())  {{old('description')}} @else {{ $post->description }} @endif</textarea>
            </div>
            @if ($errors->has('description'))
                <div class="alert alert-danger">
                    <p>{{ $errors->first('description') }}</p>
                </div>
            @endif
            <div class="content chk">
                <label for="public_flag">Public</label>
                <input type="checkbox" name="public_flag" id="public_flag" class="check" @if ($errors->any()) {{ old('public_flag') == 'on' ? 'checked' : '' }} @else @if ($post->public_flag == 1) checked @endif @endif >
            </div>
            <div class="btn">
                <a class="sub-btn" href="{{ route('posts.detail', $post->id) }}">Cancel</a>
                <button type="submit" class="sub-btn">Update</button>
            </div>
        </div>
    </form>
@endsection
