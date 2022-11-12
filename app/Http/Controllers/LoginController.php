<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function validarInicio(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            switch ($user->rol_id) {
                case 1:
                    return redirect('/administrador');
                    break;
                case 2:
                    return view('auditor.auditorDash');
                    break;
                case 3:
                    return redirect('/docente');
                    break;
            }
        }
 
        return back()->withErrors([
            'email' => 'Datos inválidos.',
        ]);
    }

    public function finalizarSesion(){
        Auth::logout();
        return redirect('/');
    }
    
}
