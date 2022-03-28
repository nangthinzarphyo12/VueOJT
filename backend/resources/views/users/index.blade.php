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
    <div class="form">
        <div class="form-content">
            <div class="main-title">
                <h2>All Users</h2>
            </div>
            <form action="{{ route('users.search') }}" method="GET" class="search-form">
                @csrf
                <div class="search-info">
                    <input type="text" name="searchInfo" id="searchInfo" @if($searchInfo!=null) value="{{$searchInfo}}" @endif placeholder="name, email, phone">
                    <button type="submit" class="sub-btn">Search</button>
                    <button type="submit" class="sub-btn delete-btn" onclick="resetData()">Reset</button>
                </div>
            </form>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p id="successMessage" name="successMessage">{{ $message }}</p>
                </div>
            @endif
            <table class="user-table">
                <tr>
                    <th width="5%">No.</th>
                    <th width="20%">Name</th>
                    <th width="20%">Email</th>
                    <th width="20%">Phone</th>
                    <th width="35%">Action</th>
                </tr>
                @if (count($users) == 0)
                    <tr>
                        <td colspan="5">
                            <p class="no-data-alert">No User Found !</p>
                        </td>
                    </tr>
                @endif
                @foreach ($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <div class="btn-group">
                                <a class="sub-btn " href="{{ route('users.detail', $user->id) }}">Detail</a>
                                @if (Auth::check())
                                    @if (Auth::user()->role == 'admin')
                                        <a class="sub-btn delete-btn" onclick="delfun({{ $user->id }})">Delete</a>
                                    @endif
                                @endif
                                <div class="confirm-box">
                                    <div id="id01" class="modal">
                                        <span onclick="document.getElementById('id01').style.display='none'"
                                            class="close" title="Close Modal">×</span>
                                        <form class="modal-content">
                                            <div class="container">
                                                <p>Are you sure you want to delete this user?</p>
                                                <div class="clearfix">
                                                    <a type="button"
                                                        onclick="document.getElementById('id01').style.display='none'"
                                                        class="sub-btn cancelbtn">Cancel</a>
                                                    <a type="button"
                                                        onclick="document.getElementById('id01').style.display='none'"
                                                        class="sub-btn deletebtn" id="deletebtn" name="deletebtn">Delete</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            @if ($users != null)
                <div class="pagination-group">
                    {{ $users->links() }}
                </div>
            @endif
            @if (Auth::check())
                @if (Auth::user()->role == 'admin')
                    <div class="create-btn">
                        <a class="sub-btn " href="{{ route('users.create') }}">Create User</a>
                    </div>
                @endif
            @endif
        </div>
    </div>
    <script>
        function delfun(deleteId) {
            var url = '{{ route('users.delete', ':id') }}';
            url = url.replace(':id', deleteId);
            document.getElementById('id01').style.display = 'block';
            document.getElementById("deletebtn").href = url;
        }
        var modal = document.getElementById('id01');
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
