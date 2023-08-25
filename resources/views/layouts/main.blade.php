<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('main.index') }}">Main</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('book.index') }}">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}">Authors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="{{ route('genre.index') }}">Genres</a>
                </li>
            </ul>
        </nav>
    </div>

    @yield('content')

</body>
</html>
