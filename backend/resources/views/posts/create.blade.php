@extends('layout')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST" class="form">
        @csrf
        <div class="form-content">
            <div class="main-title">
                <h2>Add New Post</h2>
            </div>
            <div class="content">
                <label for="title">Title<span class="required-sign">*</span></label>
                <input type="text" name="title" id="title" value="{{old('title')}}" placeholder="title">
            </div>
            @if ($errors->has('title'))
                <div class="alert alert-danger">
                    <p>{{ $errors->first('title') }}</p>
                </div>
            @endif
            <div class="content">
                <label for="description">Description<span class="required-sign">*</span></label>
                <textarea type="text" name="description" id="description" placeholder="description" class="description-area" rows="6">@if ($errors->any())  {{old('description')}} @endif</textarea>
            </div>
            @if ($errors->has('description'))
                <div class="alert alert-danger">
                    <p>{{ $errors->first('description') }}</p>
                </div>
            @endif
            <div class="content chk">
                <label for="public_flag">Public</label>
                <input type="checkbox" name="public_flag" id="public_flag" class="check" @if ($errors->any()) {{ old('public_flag') == 'on' ? 'checked' : '' }} @endif>
            </div>
            <div class="btn">
                <a class="sub-btn" href="{{ route('postList') }}">Back</a>
                <button type="submit" class="sub-btn">Add</button>  
            </div>
        </div>
    </form>
@endsection
