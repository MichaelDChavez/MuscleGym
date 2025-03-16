<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMail;
use App\Mail\SatisfaccionMail;
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

            if(!empty($request->servicio_salud)){
                DB::table('servicio_salud')->insert([
                    "ID_Servicio_Salud" => uniqid(),
                    "ID_Cliente" => Auth::user()->id,
                    "Historial_Medico" => $request->servicio_salud,
                    "Foto" => $request->file('file')->store('public/historico')
                ]);
            }

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
        $data = [
            "usuarios" => DB::table('users as u')
                ->where('rol', 2)
                // ->join('planes_nutricionales as pn', 'u.id', '=', 'pn.Id_Cliente')
                ->get(),
            "planes" => DB::table('planes_nutricionales')
                ->get(),
        ];

        if(Auth::user()->rol == 2) {
            $data["membresia"] = DB::table("ventas")
                ->where("ID_Cliente", Auth::user()->id)
                ->first();
        }

        return view('principal/servicios', $data);
    }

    public function agregarPlanUsuario(Request $request) {
        try {

            DB::table('planes_usuario')->insert([
                "ID_Cliente" => Auth::user()->id,
                "ID_Plan" => $request->idPlan
            ]);

            return back()->with('planUsuario', 'Se agrego el plan de alimentación');
        } catch (\Exception $e) {
            Log::error("Ocurrio un error agregarPlanUsuario: " . $e->getMessage());
            return back()->with('planUsuario', 'Ocurrio un error');
        }
    }

    public function eliminarPlanUsuario($usuario, $plan) {
        try {
            DB::table('planes_usuario')->where([
                "ID_Cliente" => $usuario,
                "ID_Plan" => $plan
            ])->delete();

            return back()->with('planUsuario', 'Se eliminó el plan de alimentación');
        } catch (\Exception $e) {
            Log::error('Ocurrio un error al eliminar el plan: ' . $e->getMessage());
            return back()->with('planUsuario', 'Ocurrio un error');
        }
    }

    public function agregarPlanNutricional(Request $request) {
        try {
            $data = $request->except('_token');
            $data['Id_plan_nutricional'] = uniqid();
            $data['Estado'] = 1;

            DB::table('planes_nutricionales')->insert($data);

            return back()->with('planUsuario', 'Se agrego el plan de alimentación');
        } catch (\Exception $e) {
            Log::error('Ocurrio un error al agregar plan nutricional: ' . $e->getMessage());
            return back()->with('planUsuario', 'Ocurrio un error');
        }
    }

    public function verDietas(){
        $data = [
            "dietas" => DB::table('planes_nutricionales')
                ->get(),
        ];
        return view('principal.dietas',$data);
    }

    public function editarDieta($id, Request $request){
        try {
            $dieta = DB::table('planes_nutricionales')
                ->where('Id_plan_nutricional', $id)
                ->update([
                    "Calorias_Diarias" => $request->Diarias_hidden,
                    "Proteinas" => $request->Proteinas_hidden,
                    "Carbohidtaros" => $request->Carbohidtaros_hidden,
                    "Grasas" => $request->Grasas_hidden,
                    "Ejemplo" => $request->Ejemplo_hidden,
                ]);

            return back()->with('dietaMessage', 'Se actualizo la dieta correctamente');
        } catch (\Exception $e) {
            logs("Ocurrio un error en editar Dieta: ". $e->getMessage());
            return back()->with('dietaMessage', 'Ocurrio un erro al tratar de actualizar');
        }
    }

    public function deleteDieta($id){
        try {
            DB::table('planes_nutricionales')
                ->where('Id_plan_nutricional', $id)
                ->delete();

                return back()->with('dietaMessage', 'Se elimino la dieta correctamente');
        } catch (\Exception $e) {
            logs('Ocurrio un error en eliminar Dieta: '. $e->getMessage());
            return back()->with('dietaMessage', 'Ocurrio un error al tratar de eliminar la dieta');
        }
    }

    public function encuestaView(){
        $data = [
            "usuarios" => DB::table('users as u')
                ->leftJoin('ventas as v', 'v.ID_Cliente', '=', 'u.id')
                // ->join('seguimiento as se', 'se.ID_Cliente', '=', 'u.id')
                ->where('u.rol', '=', '2')
                ->where('v.pagado', '=', 1)
                ->whereNotNull('v.ID_Cliente')
                ->orderBy('created_at', 'desc')
                ->get()
            ];
        return view('encuestas/satisfaccion', $data);
    }

    public function correoSatisfaccion($id){
        try {
            $correo = DB::table('users')
                ->where('id', $id)
                ->value('email');

            $data = [
                "id" => $id
            ];

            Mail::to($correo)->send(new SatisfaccionMail($data));
            return back()->with('correoMessage', 'Se envio el correo exitosamente');
        } catch (\Exception $e) {
            logs('Ocurrio un error al enviar el correo de satisfaccion: ' . $e->getMessage());
            return back()->with('correoMessage', 'Ocurrio un error al tratar de enviar el correo');
        }
    }
}
