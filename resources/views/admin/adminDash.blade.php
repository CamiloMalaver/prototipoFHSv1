@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row mt-5 mb-2 justify-content-around">
        <div class="col-md-5 col-sm-12 align-self-center">
            <h2 class="text-center">Gestión de usuarios</h2>
        </div>
        <div class="col-md-5 col-sm-12 align-self-center">
            <div class="input-group justify-content-center">
                <div class="form">
                    <input type="search" id="form1" class="form-control" placeholder="Buscar" />
                </div>
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <!--Mensajes del server-->
        @if ($errors->any())
        <div class="text-danger text-center fw-bolder w-50 mx-auto">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                {{ $error }} <br>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show w-25" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <!--Mensajes del server-->
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nombres</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <td>{{ $user->nombres . ' ' . $user->apellidos }}</td>
                        <td>{{ $user->rol->nombre_rol}}</td>
                        <td><button class="btn m-0" onclick="edit('{{$user->id}}')" data-toggle="tooltip" data-placement="top" title="Editar usuario."><img src="https://cdn-icons-png.flaticon.com/512/143/143437.png" style="width: 25px;" alt=""></button></td>
                    </tr>
                    @endforeach
                </tbody>
                <div class="position-fixed" style="bottom: 25px; right: 25px;">
                    <button class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#modalNewUser" data-toggle="tooltip" data-placement="top" title="Agregar nuevo usuario">
                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="green" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="filter: drop-shadow(3px 5px 2px rgb(0 0 0 / 0.4));">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg>
                    </button>
                </div>
            </table>
            <div style="justify-content: center !important;">{{ $users->links() }}</div>
        </div>
    </div>
</div>


<!-- Modal Nuevo Usuario-->
<div class="modal fade" id="modalNewUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">AGREGAR NUEVO USUARIO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="POST" action="{{route('adminNuevoUsuario')}}" id="nuevousuarioform">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="documento" placeholder="Numero de documento" maxlength="15" required>
                            <label for="floatingInput">Numero de documento</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nombres" placeholder="Nombres" maxlength="50" required>
                            <label for="floatingInput">Nombres</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" maxlength="50" required>
                            <label for="floatingPassword">Apellidos</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="celular" placeholder="Numero teléfono" maxlength="10" required>
                            <label for="floatingInput">Numero de teléfono</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="select_rol" name="select_rol" onchange="displayDivDemo('div_select_programa', this)">
                                @foreach($roles as $rol)
                                <option value='{{$rol->id}}'>{{$rol->nombre_rol}}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectGrid">Rol</label>
                        </div>
                        <div class="form-floating mb-3" id="div_select_programa" style="display: none;">
                            <select class="form-select" id="select_programa" name="select_programa">
                                @foreach($programas as $programa)
                                <option value='{{$programa->id}}'>{{$programa->nombre}}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectGrid">Programa</label>
                            <p class="text-muted fw-light" style="font-size: 0.9rem;">*Puedes agregar más programas en el apartado Programas del menú lateral.</p>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Correo electrónico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword1" name="password" placeholder="Contraseña" required>
                            <label for="floatingPassword">Contraseña</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword2" name="password_confirmation" placeholder="Repetir contraseña" required>
                            <label for="floatingPassword">Repetir contraseña</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Usuario-->
<div class="modal fade" id="modalUpdateUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">EDITAR USUARIO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="POST" action="{{route('adminEditarUsuario')}}" id="editusuarioform">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="number" id="documentoEdit" class="form-control" name="documento" placeholder="Numero de documento" maxlength="15" disabled>
                            <label for="floatingInput">Numero de documento</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" id="nombresEdit" class="form-control" name="nombres" placeholder="Nombres" maxlength="50" disabled>
                            <label for="floatingInput">Nombres</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" id="apellidosEdit" class="form-control" name="apellidos" placeholder="Apellidos" maxlength="50" disabled>
                            <label for="floatingPassword">Apellidos</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" id="celularEdit" class="form-control" name="celular" placeholder="Numero teléfono" maxlength="10" required>
                            <label for="floatingInput">Numero de teléfono</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="select_rol2" name="" onchange="displayDivDemo('div_select_programa2', this)" disabled>
                                @foreach($roles as $rol)
                                <option value='{{$rol->id}}'>{{$rol->nombre_rol}}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectGrid">Rol</label>
                        </div>
                        <div class="form-floating mb-3" id="div_select_programa2" style="display: none;">
                            <select class="form-select" id="select_programa2" name="" disabled>
                                @foreach($programas as $programa)
                                <option value='{{$programa->id}}'>{{$programa->nombre}}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectGrid">Programa</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" id="emailEdit" class="form-control" id="floatingInput" name="email" placeholder="Correo electrónico" style="background-color: #e9ecef;" readonly>
                            <label for="floatingInput">Correo electrónico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword3" name="password" placeholder="Contraseña">
                            <label for="floatingPassword">Contraseña</label>
                            <p class="text-muted fw-light" style="font-size: 0.9rem;">*Omitir campos de contraseña si no se desea editar.</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword4" name="password_confirmation" placeholder="Repetir contraseña">
                            <label for="floatingPassword">Repetir contraseña</label>
                            <p></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function displayDivDemo(id, elementValue) {
        document.getElementById(id).style.display = elementValue.value == 3 ? 'block' : 'none';
    }

    function edit(identificador) {
        $.ajax({
            url: "{{route('detallesUsuario')}}",
            method: "GET",
            data: {
                id: identificador,
            },
            success: function(data) {
                $('#documentoEdit').val(data.documento);
                $('#nombresEdit').val(data.nombres);
                $('#apellidosEdit').val(data.apellidos);
                $('#celularEdit').val(data.celular);
                $('#select_rol2').val(data.rol_id);
                $('#select_programa2').val(data.programa_id);
                $('#emailEdit').val(data.email);
            }
        });

        $("#modalUpdateUser").modal('show');

    };
</script>
@endsection