<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class ApiController extends Controller
{
    public function cantidadProductos(){
        try {
            $productosConsulta = FacadesDB::table("productos")->get();

            $productos = [];

            foreach($productosConsulta as $producto){
                $productos[$producto->Nombre] = $producto->Cantidad_disponible;
            }

            return response()->json([
                "status" => "success",
                "data" => $productos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function respuestaSatisfaccion($idUsuario, $idRespuesta) {
        try {
            $exists = FacadesDB::table('seguimiento')
                ->where('ID_Cliente', $idUsuario)
                ->exists();

            $respuesta = match($idRespuesta){
                "1" => "Malo",
                "2" => "Regular",
                "3" => "Bueno"
            };

            if($exists){
                FacadesDB::table('seguimiento')
                    ->where('ID_Cliente', $idUsuario)
                    ->update([
                        "Responsable" => $respuesta
                    ]);
            }
            else{
                FacadesDB::table('seguimiento')
                    ->insert([
                        "ID_Seguimiento" => uniqid(),
                        "ID_Cliente" => $idUsuario,
                        "Responsable" => $respuesta
                    ]);
            }

            return back()->with('mensaggeHome', 'Gracias por contestar la');
        } catch (\Exception $e) {
            logs('Ocurrio un error al guardar la respuesta: ' . $e->getMessage());
            return back()->with('mensaggeHome', 'Ocurrio un error, intente de nuevo');
        }
    }
}
