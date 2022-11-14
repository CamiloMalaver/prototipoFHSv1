@extends('layout.app')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row mt-5 mb-2 justify-content-around">
        <div class="col-md-5 col-sm-12 align-self-center justify-content-center">
            <h2 class="text-center">Registro general de funciones</h2>
            <h5 class="text-center">Espacio de trabajo: {{Auth::user()->espaciotrabajo()->get()[0]->nombre}}</h5>
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
    @if (!$EspacioTrabajo == null)
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nombre Docente</th>
                        <th scope="col">Tipo de función</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rs as $reporte)
                    <tr>
                        <td>{{ $reporte->doc_nombre . ' ' . $reporte->doc_apellido}}</td>
                        <td>{{ $reporte->tp_nombre}}</td>
                        <td>{{ $reporte->e_nombre}}</td>
                        <td>
                            <button class="btn m-0" onclick='view("{{$reporte->fs_id}}")'>
                                <i class="bi bi-eye fs-4" style="color: #0d6efd" data-toggle="tooltip" data-placement="top" title="Revisar"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="justify-content: center !important;">{{ $rs->links() }}</div>
        </div>
    </div>
    @else
    <h5 class="text-center mt-5 fw-light">Aún no te han asignado un grupo de trabajo :(.</h5>
    @endif
</div>

<!-- Modal Revisar Reporte-->
<div class="modal fade" id="modalGetDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">REPORTE DE FUNCIÓN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container fluid">
                    <input type="hidden" id="id_fs">
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
                    <div class="row d-flex justify-content-around">
                        <div class="col-sm-12 col-md-12">
                            <div class="mb-3">
                                <label for="formFileMultiple" name="anexos" class="form-label">Anexo de evidencias</label>
                                <input class="form-control" type="file" id="formFile" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-around">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="observaciones_audit" id="observacionesAudit" placeholder="Observaciones auditor" minlength="10" maxlength="500" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Observaciones auditor</label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex text-center">
                        <div class="col-sm-6 col-md-6 align-self-center">
                            <button type="button" id="btnRechazo" class="btn btn-lg btn-outline-danger" onclick="save(0)">Rechazar</button>
                        </div>
                        <div class="col-sm-6 col-md-6 align-self-center">
                            <button type="button" id="btnAprueba" class="btn btn-lg btn-outline-success" onclick="save(1)">Aprobar</button>
                        </div>
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
                console.log(data);
                $('#id_fs').val(identificador);
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
                if(data.estado_id != 1){
                    $('#observacionesAudit').val(data.observaciones_auditor);   
                    $('#observacionesAudit').prop('disabled', true);
                    $('#btnRechazo').css("display", "none");   
                    $('#btnAprueba').css("display", "none");           
                }else{
                    $('#observacionesAudit').val(''); 
                    $('#observacionesAudit').prop('disabled', false);
                    $('#btnRechazo').css("display", "inline-block");   
                    $('#btnAprueba').css("display", "inline-block");
                }                
                             
                $("#modalGetDetails").modal('show');
            }
        });
    }

    function save(key) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('auditorRevisa')}}",
            method: "POST",
            headers: {
                Authorization: $("#csrf").val()
            },
            data: {
                id_fs: $('#id_fs').val(),
                estado: key,
                observaciones: $('#observacionesAudit').val(),
            },
            success: function(data) {
                console.log(data);
                location.reload();
            }
        });
    }
</script>
@endsection