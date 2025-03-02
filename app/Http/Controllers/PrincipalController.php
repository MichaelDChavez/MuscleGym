<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PrincipalController extends Controller
{
    public function formularioContacto(){
        return view('contacto.formulario');
    }

    public function envioContacto(Request $request){
        try {
            $data = [
                'ID' => uniqid(),
                'nombre' => $request->nombre,
                'email' => $request->email,
                'celular' => $request->celular,
                'medioContacto' => $request->medioContacto,
            ];

            $contacto = DB::table('contacto')->insert($data);

            if($contacto){
                Mail::to($request->email)->send(new ContactoMail($data));
                return redirect()->route('formulario.contacto')->with('contacto', 'Gracias por contactarnos');
            }
            else {
                return redirect()->route('formulario.contacto')->with('contacto', 'Ocurrio un error, intentelo nuevamente');
            }

        } catch (\Exception $e) {
            Log::error('Ocurrio un error al guardar el formulario: ' . $e->getMessage());
            return redirect()->route('formulario.contacto')->with('contacto', 'Ocurrio un error, intentelo nuevamente');
        }
    }

    public function primerIngreso(Request $request){
        try {
            $cliente = DB::table("cliente")->insert([
                "ID_Cliente" => Auth::user()->id,
                "p_Nombre" => Auth::user()->name,
                "p_Apellido" => Auth::user()->name,
                "Fecha_Nacimiento" => $request->fechaNacimiento,
                "Genero" => $request->genero,
                "Telefono" => $request->telefono,
                "Email" => Auth::user()->email,
                "Dirección" => $request->direccion,
                "Estado" => 1,
            ]);

            if($cliente){
                User::where('id', Auth::user()->id)
                    ->update(['primer_ingreso' => 1]);
            }

            return back()->with('primerIngresoMensaje', 'Se registraron los datos');
        } catch (\Exception $e) {
            Log::error("Ocurrio un error al registrar el primer ingreso: " . $e->getMessage());
            return back()->with('primerIngresoMensaje', 'Ocurrio un error');
        }
    }
    public function servicios(){
        return view('principal/servicios');
    }
}
