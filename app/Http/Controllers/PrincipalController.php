<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMail;
use App\Mail\PasswordMail;
use App\Mail\SatisfaccionMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

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
            $request->validate([
                "fechaNacimiento" => [
                    'date',
                    'required',
                    'before_or_equal:' . Carbon::now()
                        ->subYears(14)
                        ->format('Y-m-d')
                ]
            ]);

            $clienteValidate = DB::table('cliente')
                ->where('ID_Cliente', Auth::user()->id)
                ->exists();

            if(!$clienteValidate){
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
            }


            if(!empty($request->servicio_salud)){
                if($request->file('file')){
                    DB::table('servicio_salud')->insert([
                        "ID_Servicio_Salud" => uniqid(),
                        "ID_Cliente" => Auth::user()->id,
                        "Historial_Medico" => $request->servicio_salud,
                        "Foto" => $request->file('file')->store('public/historico')
                    ]);
                }
                else {
                    DB::table('servicio_salud')->insert([
                        "ID_Servicio_Salud" => uniqid(),
                        "ID_Cliente" => Auth::user()->id,
                        "Historial_Medico" => $request->servicio_salud
                    ]);
                }
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
                ->where("Pagado", 1)
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

    public function carritoShow(){
        $data = [
            "productos" => DB::table('ventas_productos')
                ->where('ID_Cliente', Auth::user()->id)
                ->where('Pagado', 0)
                ->where('Estado', 1)
                ->select('ID_Producto', DB::raw('SUM(Cantidad) as total_cantidad'), DB::raw('SUM(Subtotal) as total_precio'))
                ->groupBy('ID_Producto')
                ->get(),
            "membresias" => DB::table('ventas')
                ->where('ID_Cliente', Auth::user()->id)
                ->where('Pagado', 0)
                ->get()
        ];

        return view('carrito.carrito', $data);
    }

    public function productosCarrito(Request $request) {
        try {
            $productos = DB::table('ventas_productos')
                ->where('ID_Cliente', Auth::user()->id)
                ->update([
                    'Pagado' => 1,
                    'Comprobante' => $request->file('file')->store('public/ventas_productos')
                ]);

            if($productos)
                return back()->with('carritoMessage', 'Se genero el pago exitosamente');
            else
                return back()->with('carritoMessage', 'Ocurrio un error al generar el pago');

        } catch (\Exception $e) {
            logs('Ocurrio un error productosCarrito:' . $e->getMessage());
            return back()->with('carritoMessage', 'Ocurrio un error');
        }
    }

    public function productosMembresia(Request $request) {
        try {
            $productos = DB::table('ventas')
                ->where('ID_Cliente', Auth::user()->id)
                ->update([
                    'Pagado' => 1,
                    'Comprobante' => $request->file('file')->store('public/ventas_membresia')
                ]);

            if($productos)
                return back()->with('carritoMessage', 'Se genero el pago de la membresia exitosamente');
            else
                return back()->with('carritoMessage', 'Ocurrio un error al generar el pago');

        } catch (\Exception $e) {
            logs('Ocurrio un error productosCarrito:' . $e->getMessage());
            return back()->with('carritoMessage', 'Ocurrio un error');
        }
    }

    public function productosCarritoEliminar($usuario) {
        try {
            $productos = DB::table('ventas_productos')
                ->where('Pagado', 0)
                ->where('ID_Cliente', $usuario)
                ->get();

            foreach($productos as $producto){
                $idProducto = $producto->ID_Producto;
                $prod = DB::table('productos')
                    ->where('ID_Producto', $idProducto)
                    ->value('Cantidad_disponible');

                DB::table('productos')
                    ->where('ID_Producto', $idProducto)
                    ->update([
                        'Cantidad_disponible' => $prod + 1
                    ]);
            }

            DB::table('ventas_productos')
                ->where('ID_Cliente', $usuario)
                ->update([
                    "Estado" => 0
                ]);
                //->delete();

            return back()->with('carritoMessage', 'Se elimino la compra');
        } catch (\Exception $e) {
            logs('Ocurrio un error al eliminar los productos: ' . $e->getMessage());
            return back()->with('carritoMessage', 'Ocurrio un error al eliminar los productos del carrito');
        }
    }

    public function quienesSomosView(){
        return view('quienessomos');
    }

    public function newPassword(){
        return view('newPassword');
    }

    public function newPasswordEmail(Request $request) {
        try {
            $emailValidate = DB::table('users')
                ->where('email', $request->email);

            if($emailValidate->exists()){
                $newPassword = $this->generatePassword(12);

                $data["password"] = $newPassword;

                $emailValidate->update([
                    "password" => Hash::make($newPassword)
                ]);

                Mail::to($request->email)->send(new PasswordMail($data));

                return back()->with('errorEmail', 'Verifica tu correo');
            }
            else {
                return back()->with('errorEmail', 'El email no existe en la base de datos');
            }
        } catch (\Exception $e) {
            return back()->with('errorEmail', 'Ocurrio un error al tratar de enviar el email');
        }
    }

    private function generatePassword($length = 12) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_-+=<>?';

        $password = '';
        $charactersLength = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $charactersLength - 1);
            $password .= $characters[$randomIndex];
        }

        return $password;
    }

    public function registrarAdministrador(){
        return view('administrador/registro');
    }

    public function registroAdministrador(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'rol' => ['required']
        ]);

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol
        ]);

        return back()->with('mensajeRegistro', 'Se creó el usuario satisfactoriamente');
    }

    public function horariosListaAdministrador(){
        $data = [
            "horarios" => DB::table('horarios')
                ->get(),
        ];
        return view('administrador/horarios', $data);
    }

    public function editarHorario($id, Request $request){
        try {
            $horario = DB::table('horarios')
                ->where('id', $id)
                ->update([
                    "horario" => $request->horario_hidden,
                    "inicio" => $request->inicio_hidden,
                    "fin" => $request->fin_hidden,
                    "descripcion" => $request->descripcion_hidden,
                ]);

            return back()->with('horarioMessage', 'Se actualizo el horario correctamente');
        } catch (\Exception $e) {
            logs("Ocurrio un error en editar Horario: ". $e->getMessage());
            return back()->with('horarioMessage', 'Ocurrio un error al tratar de actualizar');
        }
    }

    public function deleteHorario($id){
        try {
            DB::table('horarios')
                ->where('id', $id)
                ->delete();

                return back()->with('horarioMessage', 'Se elimino el horario correctamente');
        } catch (\Exception $e) {
            logs('Ocurrio un error en eliminar Horario: '. $e->getMessage());
            return back()->with('horarioMessage', 'Ocurrio un error al tratar de eliminar la dieta');
        }
    }

    public function historialMedicoUsuarios(){
        $data = [
            "historial" => DB::table('servicio_salud as ss')
                ->join('users as u', 'u.id', '=', 'ss.ID_Cliente')
                ->get()
        ];

        return view('administrador/historialMedico', $data);
    }

    public function pqrsEnvio(Request $request) {
        try {
            $email = $request->email ? $request->email : Auth::user()->email;
            $opinion = $request->opinion;

            DB::table('pqrs')->insert([
                'email' => $email,
                "opinion" => $opinion
            ]);

            return back()->with('mensaggeHome', 'Se genero el PQRS, gracias por tu opinión');
        }
        catch(\Exception $e){
            logs('error: ' . $e->getMessage());
            return back()->with('mensaggeHome', 'Error al generar el PQRS');
        }
    }

    public function pqrsLista(){
        $data = [
            "pqrs" => DB::table('pqrs')->get()
        ];
        return view('administrador.pqrs', $data);
    }

    public function pqrsUpdate(Request $request, $id) {
        try {
            DB::table('pqrs')
                ->where('id', $id)
                ->update([
                    'respuesta' => $request->respuesta,
                    'solucion' => 1
                ]);

            return back()->with('mensaggeHome', 'Se envio la respuesta');
        } catch (\Exception $e) {
            logs('error: ' . $e->getMessage());
            return back()->with('messagepqrs', 'Error al responder el PQRS');
        }
    }
}
