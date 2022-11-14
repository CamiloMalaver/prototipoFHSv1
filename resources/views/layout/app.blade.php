<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('header')

    <title>Laravel</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">

</head>

<body>

    <div class="offcanvas offcanvas-start bg-light" style="width: 20%;" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
        <div class="offcanvas-header" style="background-color: #0d6efd;">            
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body px-0" style="background-color: #0d6efd;">
            <h4 class="offcanvas-title d-none d-sm-block text-center text-light">{{ auth()->user()->nombres . ' ' . auth()->user()->apellidos }}</h4>
            <h6 class="offcanvas-title d-none d-sm-block text-center text-light">{{auth()->user()->rol->nombre_rol}}</h6>
            <hr>
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center text-light" id="menu">
                <!--Admin Links-->
                @if(auth()->user()->rol->nombre_rol == 'Administrador')
                <li>
                    <a href="{{route('adminDash')}}" class="nav-link text-truncate text-light">
                        <i class="fs-5 bi bi-people"></i><span class="ms-1 d-none d-sm-inline">Usuarios</span></a>
                </li>
                <li>
                    <a href="{{route('adminGrupos')}}" class="nav-link text-truncate text-light">
                        <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline">Grupos de trabajo</span></a>
                </li>
                @endif
                <!--Docente Links-->
                @if(auth()->user()->rol->nombre_rol == 'Docente')
                @endif
                <li>
                    <form method="get" action="/salir" id="">
                        @csrf
                        <button type="submit" class="nav-link text-truncate mt-5 text-light">
                        <i class="fs-5 bi-box-arrow-left"></i><span class="ms-1 d-none d-sm-inline">Cerrar sesion</span></button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col min-vh-100 p-4">
                <!-- toggler -->
                <button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
                
                    @yield('content')
                
            </div>
        </div>
    </div>
    <!--JQuey CDN-->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</body>

</html>