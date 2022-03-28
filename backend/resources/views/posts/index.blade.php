@extends('layout')

@section('content')

    <div class="form">
        <div class="form-content">
            <div class="main-title">
                <h2>All Posts</h2>
                @if ($message = Session::get('success'))
                    <p id="successMessage" name="successMessage" class="successMessage">{{ $message }}</p>
                @endif
            </div>
            @if (Auth::check())
                <div class="create-btn">
                    <a class="sub-btn " href="/posts/create">New Post</a>
                    {{-- <a class="sub-btn " href="/posts/import-csv">CSV Import</a> --}}
                    <form id="import-csv-form" method="POST"  action="{{ url('posts/import') }}" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                                
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <input type="file" name="file" placeholder="Choose file">
                                  </div>
                                  @error('file')
                                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                  @enderror
                              </div>              
               
                              <div class="col-md-12">
                                  <button type="submit" class="btn btn-primary" id="submit">Import CSV</button>
                              </div>
                          </div>     
                      </form>

                    <a class="sub-btn" href="{{ route('export-csv') }}">CSV Export</a>
                </div>
            @endif
            <form action="{{ route('posts.search') }}" method="GET" class="search-form">
                @csrf
                <div class="search-info">
                    <input type="text" name="searchInfo" id="searchInfo" @if ($searchInfo != null) value="{{ $searchInfo }}" @endif
                        placeholder="author name, title, description">
                    <button type="submit" class="sub-btn">Search</button>
                    <button type="submit" class="sub-btn delete-btn" onclick="resetData()">Reset</button>
                </div>
            </form>
            @if (count($posts) == 0)
                <p class="no-data-alert">No Post Found !</p>
            @endif
            @foreach ($posts as $post)
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
                        <p>
                        <div class="btn-group post-btn-group">
                            <a class="sub-btn" href="{{ route('posts.detail', $post->id) }}">Detail</a>
                            @if (Auth::check())
                                @if (Auth::user()->role == 'member')
                                    @if (Auth::user()->id == $post->created_by)
                                        <a class="sub-btn delete-btn" onclick="delfun({{ $post->id }})">Delete</a>
                                    @endif
                                @else
                                    <a class="sub-btn delete-btn" onclick="delfun({{ $post->id }})">Delete</a>
                                @endif
                            @endif
                            <div class="confirm-box">
                                <div id="deletePost" class="modal">
                                    <span onclick="document.getElementById('deletePost').style.display='none'"
                                        class="close" title="Close Modal">×</span>
                                    <form class="modal-content" action="/action_page.php">
                                        <div class="container">
                                            <p>Are you sure you want to delete this post?</p>
                                            <div class="clearfix">
                                                <a type="button"
                                                    onclick="document.getElementById('deletePost').style.display='none'"
                                                    class="sub-btn cancelbtn">Cancel</a>
                                                <a type="button"
                                                    onclick="document.getElementById('deletePost').style.display='none'"
                                                    class="sub-btn deletebtn" id="delete" name="delete">Delete</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
            @endforeach
            @if ($posts != null)
                <div class="pagination-group">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function delfun(deletePostId) {
            var url = '{{ route('posts.delete', ':id') }}';
            url = url.replace(':id', deletePostId);
            document.getElementById('deletePost').style.display = 'block';
            document.getElementById("delete").href = url;
        }
        var modal = document.getElementById('deletePost');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function resetData() {
            document.getElementById("searchInfo").value = "";
        }
    </script>
@endsection
