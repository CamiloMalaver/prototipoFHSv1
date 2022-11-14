<?php

namespace App\Http\Controllers;

use App\Models\EspacioTrabajo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\FuncionSustantiva;
use App\Models\PersonaEspacioTrabajo;
use Illuminate\Support\Facades\DB;
use App\Models\TipoFuncion;
use App\Models\User;

class AuditorController extends Controller
{
    public function Index(){
        $EspacioTrabajo = PersonaEspacioTrabajo::where('usuario_id', Auth::user()->id)->first();
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
            'e.nombre as e_nombre')
        ->paginate(15);

        $query = "SELECT funcion_sustantiva.*, users.* FROM espacio_trabajo INNER JOIN persona_espacio_trabajo ON espacio_trabajo.id = persona_espacio_trabajo.espacio_trabajo_id INNER JOIN users ON persona_espacio_trabajo.usuario_id = users.id INNER JOIN funcion_sustantiva ON users.id = funcion_sustantiva.usuario_id WHERE (espacio_trabajo.id = 1 AND users.rol_id = 3);";
        $reportes = DB::select(DB::raw($query));

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

}
