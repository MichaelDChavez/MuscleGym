<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function cantidadProductos(){
        try {
            $productosConsulta = DB::table("productos")->get();

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
}
