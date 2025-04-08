@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto2</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
</head>
<body>

    <div class="wrapper">
        
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Projeto2</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            @if(Auth::check())
                                <a class="nav-link" href="{{ route('home2') }}">Home</a>
                            @else
                                <a class="nav-link" href="{{ route('home1') }}">Home</a>
                            @endif
                        </li>
                        @if(!Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                            </li>
                            @else
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link nav-link">Logout</button>
        </form>
    </li>

    @if(auth()->user()->role === 'god')
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('god.dashboard') }}">GOD 👑</a>
                <!-- <span class="badge text-dark" href="{{ route('god.dashboard') }}">GOD 👑</span> -->
                <!-- <a class="nav-link" href="{{ route('god.dashboard') }}">Dashboard</a> -->
            </span>
        </li>
    @endif
@endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Conteúdo principal -->
        <main class="content">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>