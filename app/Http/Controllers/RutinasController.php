<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RutinasController extends Controller
{
    public function mostrarRutinas(){
        $datos = [
            'membresia' => DB::table('ventas as v')
                ->where('ID_Cliente', Auth::user()->id)
                ->where('Pagado', 1)
                ->join('membresia as m', 'v.ID_Membresia', '=', 'm.ID_Membresia')
                ->value('m.Tipo_Membresia'),
            'rutinasUsuario' => DB::table('rutinas')->where('ID_Cliente', Auth::user()->id)->get(),
            'usuarios' => DB::table('users')->where('rol', 2)->get(),
            'rutinasAdministrador' => DB::table('rutinas')->orderBy('ID_Cliente', 'asc')->get()
        ];

        return view('rutinas/rutina', $datos);
    }
}
