<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grading System</title>
  
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/data_table.css') }}">
</head>
<body class="bg-gray-200">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded" aria-label="Eleventh navbar example">
     
            <div class="container-fluid">
                <a class="navbar-brand" href="#">GRADING SYSTEM FOR COECS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExample09">
                    @auth
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if('users' == auth()->user()->getTable())
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('student')}}">Students</a>
                        </li>
                        @endif
                      
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('classes')}}">Classes</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('rank')}}">Ranking</a>
                        </li>
                       
                        
                    </ul>
                    <div>{{auth()->user()->name}}</div>
                    <div>
                        <form action="{{route('logout')}}" method="post" class="inline">
                            @csrf
                            <button class="btn btn-secondary m-2" type="submit">Logout</button>
                        </form>
                    <div>
                        @endauth
                        @guest 
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">Log in</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>  
                        </ul>
                        @endguest 
                    </div>
                </div>
            </div>
        </nav>
        @include('flash::message')
        
        @yield('content')
    </div>  
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/data_table.js') }}"></script>
    @yield('script')
</body>

</html>
