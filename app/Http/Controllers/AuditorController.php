<?php

namespace App\Http\Controllers;

use App\Models\EspacioTrabajo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\FuncionSustantiva;
use App\Models\PersonaEspacioTrabajo;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditorController extends Controller
{
    public function Index(){
        $EspacioTrabajo = PersonaEspacioTrabajo::where('usuario_id', Auth::user()->id)->first();
        
        if($EspacioTrabajo == null){
            return view('auditor.auditorDash')->with(compact('EspacioTrabajo'));
        }

        $rs = DB::table('espacio_trabajo as ep')
        ->join('persona_espacio_trabajo as pet', 'ep.id', '=', 'pet.espacio_trabajo_id')
        ->join('users as u','pet.usuario_id','=','u.id')
        ->join('funcion_sustantiva as fs', 'u.id', '=', 'fs.usuario_id')
        ->join('tipo_funcion as tp', 'fs.tipo_funcion_id', '=', 'tp.id')
        ->join('estado as e', 'fs.estado_id', '=', 'e.id')
        ->where('ep.id', '=', $EspacioTrabajo->espacio_trabajo_id)
        ->select('fs.id as fs_id',
            'u.nombres as doc_nombre',
            'u.apellidos as doc_apellido',
            'tp.nombre as tp_nombre',
            'e.nombre as e_nombre',
            'e.id as e_id')
        ->paginate(15);

        return view('auditor.auditorDash')->with(compact('EspacioTrabajo', 'rs'));
    }

    public function revisar(Request $request){
        $validate = $request->validate([
            'id_fs' => 'required',
            'estado' => 'required',
            'observaciones' => 'nullable|min:10|max:500',
        ]);
        
        $funcionSustantiva = FuncionSustantiva::find($request->id_fs);
        if($funcionSustantiva->estado_id != 1){
            return back()->withErrors('Algo anda mal...');
        }
        $funcionSustantiva->estado_id = ($request->estado == '0') ? 3 : 2;
        $funcionSustantiva->observaciones_auditor = $request->observaciones;
        $funcionSustantiva->save();
        
        return response()->json(['hello' => "recargando"], 200);

    }

    public function detallesFuncionSustantiva(Request $request){
        $result = FuncionSustantiva::where('id', $request->id)->with('tipofuncion', 'evidencia')->first();
        return $result;
    }

    public function imprimirReporte(Request $request){
        $request->validate([
            'fs_id' => 'required',
        ]);
        
        $result = FuncionSustantiva::where('id', $request->fs_id)->with('tipofuncion','evidencia','user')->first();
        // dd($result->ToArray());
        $pdf =  PDF::loadView('printing.imprimirRep', $result->ToArray());
        return $pdf->download('reporte.pdf');
    }
}
