@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row mt-5 mb-2 justify-content-around">
        <div class="col-md-5 col-sm-12 align-self-center">
            <h2 class="text-center">Registro de funciones</h2>
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
                    <tr style="
                        @switch($reporte->estado()->first()->id)
                            @case(2)
                                background-color: rgba(154, 247, 153, 0.15);
                                @break
                            @case(1)
                            background-color: rgba(246, 247, 153, 0.15);
                                @break
                            @case(3)
                            background-color: rgba(247, 153, 153, 0.15);
                                @break
                        @endswitch
                    ">
                        <td>{{ $reporte->consecutivo}}</td>
                        <td>{{ $reporte->tipofuncion()->first()->nombre}}</td>
                        <td>{{ $reporte->estado()->first()->nombre}}</td>
                        <td>
                            <button class="btn m-0" onclick='view("{{$reporte->id}}")'>
                                <i class="bi bi-eye fs-4" style="color: #0d6efd" data-toggle="tooltip" data-placement="top" title="Revisar"></i>
                            </button>
                        </td>
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
    <h5 class="text-center mt-5 fw-light">Aún no te han asignado un grupo de trabajo :(</h5>
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
                    <form class="m-0" method="POST" action="{{route('docenteNuevoReporte')}}" enctype="multipart/form-data">
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
                                    <label for="floatingInput">Hora inicio</label>
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
                                    <label for="formFileMultiple" name="" class="form-label">Anexo de evidencias</label>
                                    <input class="form-control" type="file" name="files[]" id="formFile" multiple="multiple">
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

<!-- Modal Revisar Reporte-->
<div class="modal fade" id="modalGetDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">REPORTE DE FUNCIÓN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container fluid">
                    <div class="row d-flex justify-content-around">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="consecutivoV" placeholder="Consecutivo" minlength="3" maxlength="30" disabled>
                                <label for="floatingInput">Consecutivo</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-floating mb-3" id="">
                                <input type="text" class="form-control" id="tipoFuncionV" placeholder="Tipo función" minlength="3" maxlength="30" disabled>
                                <label for="floatingSelectGrid">Tipo de función</label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-around">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-floating mb-3">
                                <input type="time" class="form-control" id="horaInicioV" placeholder="Hora inicio" disabled>
                                <label for="floatingInput">Hora inicio</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-floating mb-3">
                                <input type="time" class="form-control" id="horaFinalV" placeholder="Hora final" disabled>
                                <label for="floatingInput">Hora final</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="fechaReporteV" placeholder="Fecha reporte" disabled>
                                <label for="floatingPassword">Fecha reporte</label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-around">
                        <div class="col-sm-12 col-md-12">
                            <div class="input-group mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="involucrado1V" maxlength="50" minlength="5" placeholder="Involucrado 1" disabled>
                                    <label for="floatingInputI1">Involucrado 1</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="involucrado2V" maxlength="50" minlength="5" placeholder="Involucrado 2" disabled>
                                    <label for="floatingInputI1">Involucrado 2</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="involucrado3V" maxlength="50" minlength="5" placeholder="Involucrado 3" disabled>
                                    <label for="floatingInputI1">Involucrado 3</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-around">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="descripcionActividadV" placeholder="Descripción actividad" id="" style="height: 160px" maxlength="1000" minlength="10" disabled></textarea>
                                <label for="floatingTextarea2">Descripción actividad</label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-around">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="observacionesV" placeholder="Observaciones" minlength="10" maxlength="500" style="height: 100px" disabled></textarea>
                                <label for="floatingTextarea2">Observaciones</label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center" id="docsshow">
                    </div>
                    <div class="row justify-content-around" id="auditorObservaciones">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="observaciones_audit" id="observacionesAudit" placeholder="Observaciones auditor" minlength="10" maxlength="500" style="height: 100px" disabled></textarea>
                                <label for="floatingTextarea2">Observaciones auditor</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function view(identificador) {
        $.ajax({
            url: "{{route('docenteDetalleFS')}}",
            method: "GET",
            data: {
                id: identificador,
            },
            success: function(data) {
                let este = JSON.parse(data.involucrados);
                $('#consecutivoV').val(data.consecutivo);
                $('#tipoFuncionV').val(data.tipofuncion.nombre);
                $('#horaInicioV').val(data.hora_inicio);
                $('#horaFinalV').val(data.hora_final);
                $('#fechaReporteV').val(data.fecha);
                $('#involucrado1V').val(este.involucrado_1);
                $('#involucrado2V').val(este.involucrado_2);
                $('#involucrado3V').val(este.involucrado_3);
                $('#descripcionActividadV').val(data.descripcion_actividad);
                $('#observacionesV').val(data.observaciones);
                if (data.estado_id != 1) {
                    $('#observacionesAudit').val(data.observaciones_auditor);
                    $('#auditorObservaciones').show();
                } else {
                    $('#auditorObservaciones').hide();
                    $('#observacionesAudit').val('');
                }
                $('#docsshow').html('');
                $('#docsshow').append("<label for='floatingInput'>Evidencias</label>"); 
                data.evidencia.forEach(function(doc) {
                    let item = "<div class='col-sm-2 col-md-2 mb-3'><a class='text-center' href='" + doc.url +"' data-toggle='tooltip' data-placement='top' title='descargar archivo adjunto.'><i class='bi bi-file-earmark-arrow-down fs-1'></i>" + doc.nombre_archivo +"</a></div>";
                    $('#docsshow').append(item);                    
                });
                $("#modalGetDetails").modal('show');
            }
        });
    }
</script>
@endsection
