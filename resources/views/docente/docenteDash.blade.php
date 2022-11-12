@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row mt-5 mb-2 justify-content-around">
        <div class="col-md-5 col-sm-12 align-self-center">
            <h2 class="text-center">Registro de funciones</h2>
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
        <div class="row justify-content-evenly mt-2 mb-2">
            <div class="col-auto">
                <h4 class="text fs-6 fw-bolder d-inline">N° Horas aprobadas:</h4>
                <h6 class="text fs-6 fw-normal d-inline">123</h6>
            </div>
            <div class="col-auto">
                <h4 class="text fs-6 fw-bolder d-inline">N° Horas en revisión:</h4>
                <h6 class="text fs-6 fw-normal d-inline">123</h6>
            </div>
            <div class="col-auto d-inline">
                <h4 class="text fs-6 fw-bolder d-inline">N° Horas rechazadas:</h4>
                <h6 class="text fs-6 fw-normal d-inline">123</h6>
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
    @if (!$tieneEspacioTrabajo == null)
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Consecutivo</th>
                        <th scope="col">Tipo de función</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportes as $reporte)
                    <tr>
                        <td>{{ $reporte->consecutivo}}</td>
                        <td>{{ $reporte->tipofuncion()->first()->nombre}}</td>
                        <td>{{ $reporte->estado_id}}</td>
                        <td><button class="btn m-0" onclick="edit('')" data-toggle="tooltip" data-placement="top" title="Editar usuario."><img src="https://cdn-icons-png.flaticon.com/512/143/143437.png" style="width: 25px;" alt=""></button></td>
                    </tr>
                    @endforeach
                </tbody>
                <div class="position-fixed" style="bottom: 25px; right: 25px;">
                    <button class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#modalNewReport" data-toggle="tooltip" data-placement="top" title="Nuevo reporte">
                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="green" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="filter: drop-shadow(3px 5px 2px rgb(0 0 0 / 0.4));">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg>
                    </button>
                </div>
            </table>
        </div>
    </div>
    @else
    <h5 class="text-center mt-5 fw-light">Aún no te han asignado un grupo de trabajo :(.</h5>
    @endif
</div>

<!-- Modal Nuevo Reporte-->
<div class="modal fade" id="modalNewReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">AGREGAR NUEVO REPORTE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container fluid">
                    <form class="m-0" method="POST" action="{{route('docenteNuevoReporte')}}" id="">
                        @csrf
                        <div class="row d-flex justify-content-around">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="consecutivo" placeholder="Consecutivo" minlength="3" maxlength="30" required>
                                    <label for="floatingInput">Consecutivo</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3" id="">
                                    <select class="form-select" id="" name="tipo_funcion" required>
                                        @foreach($tiposfuncion as $funcion)
                                        <option value='{{$funcion->id}}'>{{$funcion->nombre}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelectGrid">Tipo de función</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-around">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="time" class="form-control" name="hora_inicio" placeholder="Hora inicio" required>
                                    <label for="floatingInput">Hora incio</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="time" class="form-control" name="hora_final" placeholder="Hora final" required>
                                    <label for="floatingInput">Hora final</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="fecha_reporte" placeholder="Fecha reporte" required>
                                    <label for="floatingPassword">Fecha reporte</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-around">
                            <div class="col-sm-12 col-md-12">
                                <div class="input-group mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="involucrado_1" id="" maxlength="50" minlength="5" placeholder="Involucrado 1">
                                        <label for="floatingInputI1">Involucrado 1</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="involucrado_2" id="" maxlength="50" minlength="5" placeholder="Involucrado 2">
                                        <label for="floatingInputI1">Involucrado 2</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="involucrado_3" id="" maxlength="50" minlength="5" placeholder="Involucrado 3">
                                        <label for="floatingInputI1">Involucrado 3</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-around">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="descripcion_actividad" placeholder="Descripción actividad" id="" style="height: 160px" maxlength="1000" minlength="10" required></textarea>
                                    <label for="floatingTextarea2">Descripción actividad</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-around">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="observaciones" placeholder="Observaciones" id="" minlength="10" maxlength="500" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Observaciones</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-around">
                            <div class="col-sm-12 col-md-12">
                                <div class="mb-3">
                                    <label for="formFileMultiple" name="anexos" class="form-label">Anexo de evidencias</label>
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Reportar</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<script type="text-javascript">
</script>
@endsection