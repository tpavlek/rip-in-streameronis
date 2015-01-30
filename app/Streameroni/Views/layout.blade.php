<html>
<head>
    <link rel="stylesheet" href="/css/all.css">
    <style>

    </style>
    <title>@yield('title', "") - Streameroni</title>
</head>
<body>
<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
<header class="nav-header">
    <h1>Streameroni</h1>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            @if (Auth::check())
                <li><a href="#">My Subs</a></li>
            @else
                <li><a href="#">Login</a></li>
            @endif
        </ul>
    </nav>
</header>
<div class="wrap">
    @yield('content')
</div>



</body>
</html>
