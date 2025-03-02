<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HorariosController extends Controller
{
    public function horariosShow(){
        $data = [
            "horarios" => DB::table("horarios_cliente")
                ->join("horarios", "horarios.id", "=", "horarios_cliente.id_horario")
                ->join("users", "users.id", "=", "horarios_cliente.id_cliente")
                ->select("*", "users.name as name")
                ->get(),
            "horarios_cliente" => DB::table("horarios")->get(),
            "horarioActual" => DB::table("horarios_cliente")
                ->join("horarios", "horarios.id", "=", "horarios_cliente.id_horario")
                ->where("id_cliente", Auth::user()->id)
                ->first(),
        ];
        return view("horarios/horarios", $data);
    }

    public function horariosStore(Request $request) {
        try {
            DB::table("horarios")->insert([
                "horario" => $request->horario,
                "inicio" => $request->inicio,
                "fin" => $request->fin,
                "descripcion" => $request->descripcion,
            ]);

            return back()->with("horarioMensaje", "Se registro el horario correctamente");
        } catch (\Exception $e) {
            logs("Ocurrio un error: ". $e->getMessage());

            return back()->with("horarioMensaje", "Ocurrio un error");
        }
    }

    public function horarioClienteCreate(Request $request){
        try {
            $validate = DB::table("horarios_cliente")->where("id_cliente", Auth::user()->id)->exists();

            if($validate) {
                DB::table("horarios_cliente")->update([
                    "id_cliente" => Auth::user()->id,
                    "id_horario" => $request->horario,
                ]);
            }
            else {
                DB::table("horarios_cliente")->insert([
                    "id_cliente" => Auth::user()->id,
                    "id_horario" => $request->horario,
                ]);
            }

            return back()->with("horarioMensaje", "Se registro el horario correctamente");
        } catch (\Exception $e) {
            logs("Ocurrio un error: ". $e->getMessage());

            return back()->with("horarioMensaje", "Ocurrio un error");
        }
    }

    public function eliminarHorarioCliente($id){
        try {
            DB::table("horarios_cliente")
                ->where("id_cliente", Auth::user()->id)
                ->where("id_horario", $id)
                ->delete();

            return back()->with("horarioMensaje", "Se elimino el horario correctamente");
        } catch (\Exception $e) {
            //throw $th;
            logs("Ocurrio un error: ". $e->getMessage());
            return back()->with("horarioMensaje", "Ocurrio un error");
        }
    }

}
