 <!-- Modal Revisar Reporte-->
 <div class="container mt-3 mb-5">
     <div class="row align-self-center text-center mb-3">
         <h3 class="text-center fs-3 fw-normal lh-1">{{$user['nombres'] . ' ' . $user['apellidos']}}</h3>
         <h3 class="text-center fs-6 fw-lighter lh-1">Docente</h3>
     </div>
     <div class="row d-flex justify-content-around mb-3">
         <div class="col-sm-12 col-md-4">
             <h5 class="text-center fw-normal fs-5 lh-1">{{$user['documento']}}</h5>
             <h3 class="text-center fs-6 fw-lighter lh-1">Documento</h3>
         </div>
         <div class="col-sm-12 col-md-4">
             <h5 class="text-center fw-normal fs-5 lh-1">{{$user['email']}}</h5>
             <h3 class="text-center fs-6 fw-lighter lh-1">Email</h3>
         </div>
         <div class="col-sm-12 col-md-4">
             <h5 class="text-center fw-normal fs-5 lh-1">{{$user['celular']}}</h5>
             <h3 class="text-center fs-6 fw-lighter lh-1">Celular </h3>
         </div>
     </div>
     <hr>
     <div class="row d-flex justify-content-around">
         <div class="col-sm-12 col-md-6">
             <div class="">
                 <label for="">Consecutivo</label>
                 <input type="text" class="" id="consecutivoV" placeholder="Consecutivo" minlength="3" maxlength="30" value="{{$consecutivo}}" readonly>
             </div>
         </div>
         <div class="col-sm-12 col-md-6">
             <div class="" id="">
                 <label for="">Tipo de función</label>
                 <input type="text" class="" id="tipoFuncionV" placeholder="Tipo función" minlength="3" maxlength="30" value="{{$tipofuncion['nombre']}}" readonly>
             </div>
         </div>
     </div>
     <div class="row d-flex justify-content-around">
         <div class="col-sm-12 col-md-3">
             <div class="">
                 <label for="">Hora inicio</label>
                 <input type="text" value="{{$hora_inicio}}" readonly>
             </div>
         </div>
         <div class="col-sm-12 col-md-3">
             <div class="">
                 <label for="">Hora final</label>
                 <input type="text" value="{{$hora_final}}" readonly>
             </div>
         </div>
         <div class="col-sm-12 col-md-3">
             <div class="">
                 <label for="">Total horas y minutos</label>
                 <input type="text" class="" id="horaFinalV" placeholder="Hora final" value="
                 @php
                    $hora1 = new DateTime($hora_inicio);
                    $hora2 = new DateTime($hora_final);
                    $interval = $hora1->diff($hora2);
                    echo ($interval->format('%h:%i'));
                 @endphp
                 " readonly>
             </div>
         </div>
         <div class="col-sm-12 col-md-3">
             <div class="">
                 <label for="">Fecha reporte</label>
                 <input type="text" value="{{$fecha}}" readonly>
             </div>
         </div>
     </div>
     <div class="row d-flex justify-content-around">
         <div class="col-sm-12 col-md-12">
             <div class="">
                 @foreach (json_decode($involucrados) as $invol)
                 <div class="">
                     <label for="">Involucrado</label>
                     <input type="text" class="" id="involucrado1V" maxlength="50" minlength="5" placeholder="" value="{{$invol}}" readonly>
                 </div>
                 @endforeach
             </div>
         </div>
     </div>
     <div class="row d-flex justify-content-around">
         <div class="col-sm-12 col-md-12">
             <div class="">
                 <label for="">Descripción actividad</label>
                 <textarea class="" id="descripcionActividadV" placeholder="Descripción actividad" id="" style="height: 160px" maxlength="1000" minlength="10"  readonly>{{$descripcion_actividad}}</textarea>
             </div>
         </div>
     </div>
     <div class="row d-flex justify-content-around">
         <div class="col-sm-12 col-md-12">
             <div class="">
                 <label for="">Observaciones</label>
                 <textarea class="" id="observacionesV" placeholder="Observaciones" minlength="10" maxlength="500" style="height: 100px" readonly>{{$observaciones}}</textarea>
             </div>
         </div>
     </div>
     <div class="row justify-content-around" id="">
         <div class="col-sm-12 col-md-12">
             <div class="">
                 <label for="">Observaciones auditor</label>
                 <textarea class="" name="observaciones_audit" id="observacionesAudit" placeholder="Observaciones auditor" minlength="10" maxlength="500" style="height: 100px" readonly>{{$observaciones_auditor}}</textarea>
             </div>
         </div>
     </div>
     <div class="row justify-content-around" id="">
     <label class="mb-2" for="">Evidencias</label>
     @foreach ($evidencia as $evid)
                 <div class="">
                     {{$evid['url']}}
                 </div>
                 @endforeach
     </div>
 </div>