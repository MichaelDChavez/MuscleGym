<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;

class TiendaController extends Controller
{
    public function mostrarTienda(){
        return view('tienda/tienda');
    }

    public function mostrarMembresias(){
        // DB::table('users')
        //     ->select('users.id','users.name','profiles.photo')
        //     ->join('profiles','profiles.id','=','users.id')
        //     ->where(['something' => 'something', 'otherThing' => 'otherThing'])
        //     ->get();
        $datos = [
            'membresias' => DB::table('membresia')->get(),
            'ventas' => DB::table('ventas')
                ->join('users', 'users.id', '=', 'ventas.ID_Cliente')
                ->join('membresia', 'membresia.ID_Membresia', '=', 'ventas.ID_Membresia')
                ->select('ventas.ID_Cliente', 'ventas.ID_Venta', 'ventas.Monto_o_Cantidad', 'users.name', 'ventas.ID_Membresia', 'ventas.Fecha', 'membresia.Tipo_Membresia')
                ->get()
        ];

        if(Auth::user()->rol == 2){
            $datos['membresiaUsuario'] = DB::table('ventas')
                ->where('ID_Cliente', Auth::user()->id)
                ->first();
        }

        return view('tienda/membresias', $datos);
    }

    public function guardarMembresia($id){
        date_default_timezone_set('America/Bogota');
        try {

            $consulta = DB::table('ventas')
                ->where('ID_Cliente', Auth::user()->id)
                ->exists();

            if($consulta){
                $datos = [
                    'Fecha' => Carbon::now(),
                    'Monto_o_Cantidad' => $id == 401 ? 90000 : ($id == 402 ? 160000 : 400000),
                    'ID_Membresia' => $id,
                    'Estado' => 1
                ];
                DB::table('ventas')
                    ->where('ID_Cliente', Auth::user()->id)
                    ->update($datos);

                DB::table('rutinas')->where('ID_Cliente', Auth::user()->id)->delete();
                $rutinas = $this->rutinasMembresia($id);

                return $rutinas
                    ? back()->with('membresiaMensaje', 'Se actualizo su membresia')
                    : back()->with('membresiaMensaje', 'Ocurrio un error al crear la membresia');
            }
            else{

                $datos = [
                    'ID_Venta' => uniqid(),
                    'ID_Cliente' => Auth::user()->id,
                    'Fecha' => Carbon::now(),
                    'Monto_o_Cantidad' => $id == 401 ? 90000 : ($id == 402 ? 160000 : 400000),
                    'ID_Membresia' => $id,
                    'Estado' => 1
                ];
                DB::table('ventas')
                    ->insert($datos);

                $rutinas = $this->rutinasMembresia($id);

                return $rutinas
                    ? back()->with('membresiaMensaje', 'Se creo la membresia')
                    : back()->with('membresiaMensaje', 'Ocurrio un error al crear la membresia');
            }

        } catch (\Exception $e) {
            logs($e->getMessage());
            return back()->with('membresiaMensaje', 'Ocurrio un error');
        }
    }

    private function rutinasMembresia($membresia){
        try {
            switch ($membresia) {
                case "401":
                    $rutinas = [
                        [
                            "Nombre" => "EMOM de 12 minutos",
                            "Descripcion" => "Cada minuto realiza un ejercicio distinto: burpees, sentadillas con salto, kettlebell swings. Repite por 4 rondas."
                        ],
                        [
                            "Nombre" => "Thrusters con barra",
                            "Descripcion" => "Combinación de sentadilla frontal y press de hombro. 4 series de 10 repeticiones."
                        ],
                        [
                            "Nombre" => "Dominadas con lastre",
                            "Descripcion" => "Ejercicio para fortalecer la espalda y el core. Si es necesario, usar asistencia."
                        ],
                        [
                            "Nombre" => "Carrera con peso + cuerda de batalla",
                            "Descripcion" => "Corre 100 metros con un saco de arena, seguido de 30 segundos de cuerdas de batalla."
                        ],
                        [
                            "Nombre" => "Deadlifts + Box Jumps",
                            "Descripcion" => "Realiza 8 repeticiones de peso muerto con barra y 10 saltos a caja. 4 series."
                        ]
                    ];
                    break;
                case "402":
                    $rutinas = [
                        [
                            "Nombre" => "Circuito de fuerza y cardio",
                            "Descripcion" => "3 rondas de: 10 sentadillas con peso, 12 flexiones, 15 abdominales bicicleta y 200m de remo."
                        ],
                        [
                            "Nombre" => "Press de pecho con mancuernas + Remo unilateral",
                            "Descripcion" => "4 series de 12 repeticiones de press de pecho y 10 reps de remo por brazo."
                        ],
                        [
                            "Nombre" => "Peso muerto rumano con mancuernas",
                            "Descripcion" => "Ejercicio para fortalecer la cadena posterior, 3 series de 12 repeticiones."
                        ],
                        [
                            "Nombre" => "Lanzamiento de balón medicinal contra la pared",
                            "Descripcion" => "Ejercicio explosivo para el core, 3 series de 15 repeticiones."
                        ],
                        [
                            "Nombre" => "Plancha dinámica + Saltos laterales",
                            "Descripcion" => "Mantén la plancha 30 segundos y luego haz 15 saltos laterales sobre una línea."
                        ]
                    ];
                    break;
                case "403":
                    $rutinas = [
                        [
                            "Nombre" => "Sentadillas búlgaras con mancuernas",
                            "Descripcion" => "Fortalece piernas y estabilidad. 4 series de 10 repeticiones por pierna."
                        ],
                        [
                            "Nombre" => "Peso muerto sumo con barra",
                            "Descripcion" => "Menos presión en la espalda baja. 4 series de 8 repeticiones."
                        ],
                        [
                            "Nombre" => "Press de hombro con mancuernas en banco inclinado",
                            "Descripcion" => "Fortalece hombros y pecho. 3 series de 12 repeticiones."
                        ],
                        [
                            "Nombre" => "Elevaciones de pierna en barra",
                            "Descripcion" => "Ejercicio para el core y estabilidad del cuerpo. 4 series de 15 repeticiones."
                        ],
                        [
                            "Nombre" => "Trabajo de movilidad y estiramiento activo",
                            "Descripcion" => "10 minutos de ejercicios guiados para mejorar flexibilidad y evitar lesiones."
                        ]
                    ];
                    break;
                default:
                    return false;
                }

                foreach ($rutinas as $rutina) {
                    DB::table('rutinas')->insert([
                        "ID_Rutina" => uniqid(),
                        "ID_Cliente" => Auth::user()->id,
                        "Descripcion" => $rutina["Descripcion"],
                        "Estado" => 1,
                        "Nombre_rutina" => $rutina["Nombre"]
                    ]);
                }

                return true;

        } catch (\Exception $e) {
            logs($e->getMessage());
            return false;
        }
    }


    public function actualizarFechaVenta($id){
        date_default_timezone_set('America/Bogota');
        try {
            $membresia = DB::table('ventas')->where('ID_Venta', $id)->value('Fecha');
            if($membresia == Carbon::now()->format('Y-m-d')){
                return back()->with('administradorMensajes', 'La fecha ya es la actual');
            }
            else{
                DB::table('ventas')->where('ID_Venta', $id)->update([
                    'Fecha' => Carbon::now()
                ]);
                return back()->with('administradorMensajes', 'Se actualizo la fecha de membresia');
            }
        } catch (\Exception $e) {
            logs($e->getMessage());
            return back()->with('administradorMensajes', 'Ocurrio un error');
        }
    }

    public function eliminarVenta($id){
        try {
            DB::table('ventas')->where('ID_Venta', $id)->delete();
            return back()->with('administradorMensajes', 'Se elimino la membresia correctamente');
        } catch (\Exception $e) {
            logs($e->getMessage());
            return back()->with('administradorMensajes', 'Ocurrio un error');
        }
    }


    public function reportesView(){
        return view('reportes/reportes');
    }

    public function reporteDescarga(Request $request){
        try {
            $inicio = $request->fechaInicio;
            $fin = $request->fechaFin;
            $ventasReporte = DB::table('ventas as v')
                ->join('users as u', 'u.id', '=', 'v.ID_Cliente')
                ->whereDate('Fecha', '>=', $inicio)->whereDate('Fecha', '<=', $fin)
                ->get();

            $data = ['ventasReporte' => $ventasReporte];

            $pdf = Pdf::loadView('reportes.reporteGenerado', compact('ventasReporte'));
            return $pdf->download('reporteVentas.pdf');
        } catch (\Exception $e) {
            logs($e->getMessage());
            return back()->with('mensajeReporte', 'Ocurrio un error');
        }
    }

    public function reportesStock(){
        try {
            $productos = DB::table('productos as p')
                ->leftJoin('ventas_productos as vp', 'vp.ID_Producto', '=', 'p.ID_Producto')
                ->select('p.ID_Producto', 'p.Nombre', 'p.Cantidad_disponible', 'p.Proveedor', 'p.Precio', 'p.Precio_Compra', 'p.Estado', DB::raw('COALESCE(COUNT(vp.ID_Producto), 0) as cantidad_vendida'),DB::raw('COALESCE(SUM(p.Precio), 0) as total_vendido'))
                ->groupBy('p.ID_Producto', 'p.Nombre', 'p.Precio')
                ->get();


            $data = ['productos' => $productos];

            $pdf = Pdf::loadView('reportes.stock', compact('productos'));
            return $pdf->download('reporteStock.pdf');
        } catch (\Exception $e) {
            logs($e->getMessage());
            return back()->with('mensajeReporte', 'Ocurrio un error');
        }
    }
    public function reportesHorarios(){
        try {
            $horarios = DB::table('horarios_cliente as hc')
                ->join('users as u', 'u.id', '=', 'hc.id_cliente')
                ->join('horarios as h', 'h.id', '=', 'hc.id_horario')
                ->get();

            $data = ['horarios' => $horarios];

            $pdf = Pdf::loadView('reportes.horarios', compact('horarios'));
            return $pdf->download('reporteHorarios.pdf');
        } catch (\Exception $e) {
            logs($e->getMessage());
            return back()->with('mensajeReporte', 'Ocurrio un error');
        }
    }

    public function reporteSinMembresia() {
        try {
            $usuarios = DB::table('users as u')
            ->leftJoin('ventas as v', 'v.ID_Cliente', '=', 'u.id')
            ->where('u.rol', '=', '2')
            ->whereNull('v.ID_Cliente')
            ->orderBy('created_at', 'desc')
            ->get();

            $pdf = Pdf::loadView('reportes.reporteSinMembresia', compact('usuarios'));
            return $pdf->download('reporteUsuariosSinMembresia.pdf');
        } catch (\Exception $e) {
            logs($e->getMessage());
            return back()->with('mensajeReporte', 'Ocurrio un error');
        }
    }

    public function mostrarProductos(){
        $datos = [
            'productos' => DB::table('productos')
                ->where('Estado', 1)
                ->get()
        ];
        return view('tienda/productos', $datos);
    }

    public function guardarProductos(Request $request){
        try {
            $archivo = $request->file('file');
            $request->file('file')->store('public/productos');

            DB::table('productos')->insert([
                'ID_Producto' => uniqid(),
                'Nombre' => $request->nombre,
                'Descripcion' => $request->file('file')->store('public/productos'),
                'Precio' => $request->precio,
                'Cantidad_disponible' => $request->cantidad_disponible,
                'Proveedor' => $request->proveedor,
                'Estado' => 1,
                'Precio_Compra' => $request->precio_compra
            ]);


            return back()->with('productosMensaje', 'Se guardo el producto');
        } catch (\Exception $e) {
            logs($e->getMessage());
            // return back()->with('productosMensaje', 'Ocurrio un error');
            return back()->with('productosMensaje', $e->getMessage());
        }
    }

    public function eliminarProductos(Request $request){
        try {
            $validacion = DB::table('productos')->where('ID_Producto', $request->radioId)->exists();
            if($validacion){
                DB::table('productos')
                    ->where('ID_Producto', $request->radioId)
                    ->update([
                        'Estado' => 0
                    ]);
                    // ->delete();
                return back()->with('productosMensaje', 'Se inhabilito el producto');
            }
            else{
                return back()->with('productosMensaje', 'No se encontro el producto');
            }

        } catch (\Exception $e) {
            logs($e->getMessage());
            return back()->with('productosMensaje', 'Ocurrio un error');
        }
    }

    public function comprarProducto($id){
        try {
            $cantidad = DB::table('productos')->where('ID_Producto', $id)->value('Cantidad_disponible');
            if($cantidad <= 0){
                return back()->with('productosMensaje', 'No quedan productos en Stock');
            }
            else{
                DB::table('productos')->where('ID_Producto', $id)->update([
                    'Cantidad_disponible' => intval($cantidad) - 1
                ]);

                $existsId = DB::table('ventas_productos')->orderBy('ID_Venta_producto', 'desc')->exists();
                $idVenta = $existsId ? DB::table('ventas_productos')->orderBy('ID_Venta_producto', 'desc')->first() : 1;

                $productoValor = DB::table('productos')->where('ID_Producto', $id)->value('Precio');
                DB::table('ventas_productos')->insert([
                    // 'ID_Venta_producto' => $existsId ? intval($idVenta->ID_Venta_producto) + 1 : $idVenta,
                    'ID_Venta_producto' => uniqid(),
                    'ID_Cliente' => Auth::user()->id,
                    'ID_Producto' => $id,
                    'Cantidad' => 1,
                    'Subtotal' => $productoValor,
                    'Estado' => 1
                ]);
                return back()->with('productosMensaje', 'Se registro correctamente la compra');
            }
        } catch (\Exception $e) {
            logs($e->getMessage());
            return back()->with('productosMensaje', 'Ocurrio un error');
        }
    }


    public function reporteDescargaProductos(Request $request){
        try {
            $ventas = DB::table('ventas_productos')->join('productos', 'productos.ID_Producto', '=', 'ventas_productos.ID_Producto')->get();

            $pdf = Pdf::loadView('reportes.reporteProductos', compact('ventas'));
            return $pdf->download('reporteVentasProductos.pdf');
        } catch (\Exception $e) {
            logs($e->getMessage());
            return back()->with('mensajeReporte', 'Ocurrio un error');
        }
    }

    public function crearMembresiasView(){
        $data = [
            "membresias" => DB::table("membresia")->where("Estado", 1)->get()
        ];

        return view('tienda.crearMembresias', $data);
    }

    public function crearMembresia(Request $request){
        try {

            DB::table('membresia')->insert([
                "ID_Membresia" => uniqid(),
                "Tipo_Membresia" => $request->tipoMembresia,
                "Precio" => $request->precio,
                "descripcion" => $request->descripcion,
                "Estado" => 1,
            ]);

            return back()->with('mensajeMembresia', 'Se registro la membresia correctamente');

        } catch (\Exception $e) {
            logs('Ocurrio un error: '. $e->getMessage());
            return back()->with('mensajeMembresia','Ocurrio un error al momento de guardar la membresia');
        }
    }

    public function eliminarMembresia(Request $request){
        try {
            DB::table('membresia')->where('ID_Membresia', $request->radioId)->delete();
            return back()->with('mensajeMembresia','Se elimino correctamente');
        } catch (\Exception $e) {
            logs('Ocurrio un error: '. $e->getMessage());
            return back()->with('mensajeMembresia','Ocurrio un error');
        }
    }

    public function eliminarMembresiaUsuario($idUsuario) {
        try {
            DB::table('ventas')->where('ID_Cliente', $idUsuario)->delete();
            return back()->with('membresiaMensaje','Se elimino correctamente');
        } catch (\Exception $e) {
            logs('Ocurrio un error: ' . $e->getMessage());
            return back()->with('membresiaMensaje', 'Ocurrio un error');
        }
    }
}
