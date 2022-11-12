<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\EspacioTrabajo;
use App\Models\PersonaEspacioTrabajo;
use App\Models\Rol;
use App\Models\Programa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Laravel\Sanctum\PersonalAccessToken;

class AdministradorController extends Controller
{
    public function Index(){
        $users = User::paginate(10);
        $roles = Rol::all();
        $programas  = Programa::all();
        return view('admin.adminDash')->with(compact('users', 'roles', 'programas'));
    }

    public function indexGruposTrabajo(){
        $auditores = User::where('rol_id', 2)->get();
        $espacios_trabajo = EspacioTrabajo::all();
        return view('admin.adminWorkGroups')->with(compact('auditores', 'espacios_trabajo'));
    }

    public function nuevoUsuario(Request $request){
        $validated = $request->validate([
            'documento' => 'required|max:15|min:6|unique:users',
            'nombres' => 'required|max:50|min:3',
            'apellidos' => 'required|max:50|min:3',
            'celular' => 'required|max:10|min:10',
            'select_rol' => 'required',
            'select_programa' => 'nullable',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $usuario = new User();
        $usuario->documento = $request->documento;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->celular = $request->celular;
        $usuario->rol_id = $request->select_rol;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->estado_id = 1;
        if($request->select_programa == 3){
            $usuario->programa_id = $request->select_programa;
        }
        
        $usuario->save();

        return redirect()->back()->with('message', 'Se ha agregado el usuario correctamente.');

    }

    public function modificarUsuario(Request $request){
        $validated = $request->validate([
            'celular' => 'required|max:10|min:10',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $usuario = User::where('email', $request->email)->first();
        $usuario->celular = $request->celular;
        if(isset($request->password)){
            $usuario->password = Hash::make($request->password);
        }
                
        $usuario->save();

        return redirect()->back()->with('message', "Se ha modificado el usuario correctamente.");
    }

    public function obtenerDetalles(Request $request){
        $data = User::find($request->id);        
        return $data;
    }

    public function nuevoGrupoTrabajo(Request $request){

        $validated = $request->validate([
            'nombre_espacio_trabajo' => 'required|max:30|min:4',
            'auditor_id' => 'required',
        ]);

        $nuevoEspacio = new EspacioTrabajo();
        $nuevoEspacio->nombre = $request->nombre_espacio_trabajo;
        $nuevoEspacio->save();

        $persona_espacio_trabajo = new PersonaEspacioTrabajo();
        $persona_espacio_trabajo->espacio_trabajo_id = $nuevoEspacio->id;
        $persona_espacio_trabajo->usuario_id = $request->auditor_id;
        $persona_espacio_trabajo->save();

        return redirect()->back()->with('message', 'Se ha agregado el espacio de trabajo correctamente.');

    }
    
    public function agregarDocenteEspacioTrabajo(Request $request){
        $validated = $request->validate([
            'email_docente' => 'required|email|exists:users,email',
            'espacio_trabajo_id' => 'required',
        ]);
        
        $docente = User::where('email', $request->email_docente)->first();

        if($docente->rol_id != '3'){
            return back()->withErrors('El email proporcionado no corresponde a un docente');
        }

        if (PersonaEspacioTrabajo::where('usuario_id', '=', $docente->id)->exists()) {
            return back()->withErrors('El email proporcionado ya se encuentra en un grupo de trabajo.');
        }

        $relacionar = new PersonaEspacioTrabajo();
        $relacionar->usuario_id = $docente->id;
        $relacionar->espacio_trabajo_id = $request->espacio_trabajo_id;
        $relacionar->save();

        return redirect()->back()->with('message', 'Se ha agregado el usuario al espacio de trabajo correctamente.');

    }

    public function detallesEspacioTrabajo(Request $request){
        $result = DB::table('users')
        ->join('persona_espacio_trabajo', 'users.id', '=', 'persona_espacio_trabajo.usuario_id')
        ->where('persona_espacio_trabajo.espacio_trabajo_id', '=', $request->espacio_trabajo_id)
        ->get();
        return $result;
    }

}
