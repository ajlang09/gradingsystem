<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grading System</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="url" content="{{url('/')}}">

    @if(auth()->user() &&  'users' == auth()->user()->getTable() && 'teacher' == auth()->user()->roles()->first()->name)
        <meta name="teacher_id" content="{{auth()->id()}}">
    @endif
  
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/data_table.css') }}">
    @yield('style')

</head>
<body class="bg-gray-200">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded" aria-label="Eleventh navbar example">
            <div class="container-fluid">
                @auth
                <a class="navbar-brand" href="#"><img src="{{url('images/PSAU_Logo.png')}}" style="width:75px;height:75px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExample09">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if('users' == auth()->user()->getTable() && 'admin' == auth()->user()->roles()->first()->name)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('student')}}">Students</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('classes.admin')}}">Classes</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('rank.admin')}}">Ranking</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('subject.index')}}">Subject</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('users.index')}}">User</a>
                        </li>
                        @elseif(auth()->user() &&  'student_records' == auth()->user()->getTable())
                        {{-- empty  --}}
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('teacher.subjects')}}">Subject</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('teacher.class')}}">Class</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('teacher.rank')}}">Ranking</a>
                        </li>
                        @endif
                    </ul>
                    <div>{{auth()->user()->name}}</div>
                    <div>
                        <form action="{{route('logout')}}" method="post" class="inline">
                            @csrf
                            <button class="btn btn-secondary m-2" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </nav>
        @include('flash::message')
        
        @yield('content')
    </div>  
    <script type="text/javascript">
        window.apiUrl = '{{url('/')}}'
    </script>
    <script src="{{ asset(mix('/js/app.js')) }}"></script>
    <script src="{{ asset('js/data_table.js') }}"></script>
    <script src="{{ asset('js/html2canvas.js') }}"></script>
    
    @yield('script')

    @include('flash::message')

</body>

</html>
