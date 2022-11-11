@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row mt-5 mb-2 justify-content-around">
        <div class="col-md-5 col-sm-12 align-self-center">
            <h2 class="text-center">Grupos de trabajo</h2>
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
        @if (!$espacios_trabajo->isEmpty())
        @foreach ($espacios_trabajo as $espacio)
        <div class="col-auto mb-3">
            <div class="card shadow-sm" style="width: 20rem;">
                <div class="row align-items-center justify-content-between m-3">
                    <div class="col-7">
                        <h4 class="card-title mb-0 justify-content-center">{{$espacio->nombre}}</h4>
                        <p class="text mt-0">{{$espacio->users()->get()[0]->nombres . ' ' . $espacio->users()->get()[0]->apellidos}}</p>
                    </div>
                    <div class="col-5 align-items-center"><a onclick="edit('{{$espacio}}', '{{$espacio->users()->get()}}')" class="btn btn-xs btn-primary">Gestionar</a></div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <h5 class="text-center mt-5 fw-light">Aún no has creado espacios de trabajo.</h5>
        @endif
    </div>
    <div class="position-fixed" style="bottom: 25px; right: 25px;">
        <button class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#modalNewWorkGroup" data-toggle="tooltip" data-placement="top" title="Agregar nuevo usuario">
            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="green" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="filter: drop-shadow(3px 5px 2px rgb(0 0 0 / 0.4));">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
            </svg>
        </button>
    </div>
</div>


<!-- Modal Nuevo grupo de trabajo-->
<div class="modal fade" id="modalNewWorkGroup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">AGREGAR NUEVO GRUPO DE TRABAJO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="POST" action="{{route('adminNuevoGT')}}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nombre_espacio_trabajo" id="floatingInput" placeholder="Nombre del grupo" maxlength="30" minlength="4" required>
                            <label for="floatingInput">Nombre del grupo</label>
                        </div>
                        @if (!empty($auditores))
                        <div class="form-floating mb-3">
                            <select class="form-select" name="auditor_id" id="floatingSelectGrid">
                                @foreach($auditores as $auditor)
                                <option value='{{$auditor->id}}'>{{$auditor->nombres . ' ' . $auditor->apellidos}}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectGrid">Auditor a cargo</label>
                        </div>
                        @else
                        <p class="text-center">Aún no tienes Auditores registrados. Debes registrar al menos uno para relacionarlo con el grupo de trabajo.</p>
                        @endif
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success" {{empty($auditores) ? "disabled" : "" }}>Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gestionar Grupo de Trabajo -->
<div class="modal fade" id="modalgestionarGT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header d-block align-content-center">
                <h1 class="modal-title fs-3 m-0" id="titulomodalGGT"></h1>
                <h1 class="modal-title fs-5 m-0 fw-light" id="tituloauditor"></h1>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script>
    function edit(espacio, usuarios) {
        let data = JSON.parse(espacio);
        let users = JSON.parse(usuarios);
        console.log(users);
        $('#titulomodalGGT').text(data.nombre);
        $('#tituloauditor').text('Auditor a cargo: ' + users[0].nombres + ' ' +  users[0].apellidos);
        $("#modalgestionarGT").modal('show');
    };
</script>
@endsection