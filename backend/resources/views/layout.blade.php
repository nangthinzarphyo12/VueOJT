<!DOCTYPE html>
<html>

<head>
    <title>Laravel CRUD </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css"
        rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/js/common.js"></script>
</head>

<body>
    <nav class="nav-group">
        <a href="{{ route('postList') }}" class="to__home"><img src="/images/6592098_preview.png"
                class="blog-logo" /></a>
        <div class="navrow">
            @if (Auth::check())
                <a href="{{ route('users.list') }}"
                    class="nav-item-hov {{ Request::is('users/list') ? 'active' : '' }}">User List</a>
                <div class="dropdown">
                    <button class="dropbtn">
                        {{ Auth::user()->name }}
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="{{ route('auth.profileDetail', Auth::user()->id) }}">User Profile</a>
                        <a href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            @else
                <a href="{{ route('logout') }}">Login</a>
            @endif
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
