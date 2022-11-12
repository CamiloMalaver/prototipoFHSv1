<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\EspacioTrabajo;
use App\Models\FuncionSustantiva;
use App\Models\PersonaEspacioTrabajo;
use App\Models\Rol;
use App\Models\Programa;
use App\Models\TipoFuncion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Laravel\Sanctum\PersonalAccessToken;

class DocenteController extends Controller
{
    public function Index(){
        $tieneEspacioTrabajo = PersonaEspacioTrabajo::where('usuario_id', Auth::user()->id)->first();
        $tiposfuncion = TipoFuncion::All();
        $reportes = FuncionSustantiva::where('usuario_id', Auth::user()->id)->with('estado')->get();
        return view('docente.docenteDash')->with(compact('tieneEspacioTrabajo', 'tiposfuncion', 'reportes'));
    }

    public function nuevoReporte(Request $request){
        
        $validated = $request->validate([
            'consecutivo' => 'required|max:30|min:3|unique:funcion_sustantiva',
            'tipo_funcion' => 'required|exists:tipo_funcion,id',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_final' => 'required|date_format:H:i|after:hora_inicio',
            'fecha_reporte' => 'required|before:tomorrow',
            'involucrado_1' => 'nullable|min:5|max:100',
            'involucrado_2' => 'nullable|min:5|max:100',
            'involucrado_3' => 'nullable|min:5|max:100',
            'descripcion_actividad' => 'required|string|min:10|max:1000',
            'observaciones' => 'required|min:8|max:500',
        ], [
            'fecha_reporte.before' => 'Campo fecha superior a el dia de hoy.',
        ]);

        $reporte = new FuncionSustantiva();

        $reporte->usuario_id = Auth::user()->id;
        
        $reporte->consecutivo = $request->consecutivo;
        $reporte->fecha = $request->fecha_reporte;
        $reporte->hora_inicio = $request->hora_inicio;
        $reporte->hora_final = $request->hora_final;
       
        $reporte->involucrados = '{
            "involucrado_1": "' . $request->involucrado_1 . '",
            "involucrado_2": "' . $request->involucrado_2 . '",
            "involucrado_3": "' . $request->involucrado_3 . '"
         }';

        $reporte->descripcion_actividad = $request->descripcion_actividad;
        $reporte->observaciones = $request->observaciones;
        $reporte->tipo_funcion_id = $request->tipo_funcion;
        $reporte->estado_id = 2;
        $reporte->save();

        return redirect()->back()->with('message', 'Se ha agregado el reporte correctamente.');

    }

    public function detallesFuncionSustantiva(Request $request){
        $result = FuncionSustantiva::where('id', $request->id)->with('tipofuncion')->first();
        return $result;
    }


}
