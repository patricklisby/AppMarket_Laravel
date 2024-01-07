<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DetalleVentas;
use App\Models\Tenants;
use App\Models\Clientes;
use App\Models\Ventas;
use App\Models\Productos;

use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;


class BaucherController extends Controller
{
    public function Baucher(){

        $user = Auth::user();
        
        $ultimaVenta = Ventas::latest()->first();
        //dd($ultimaVenta);

        $ultimoID = $ultimaVenta->id;

        
        $ventas = Ventas::where('id', $ultimoID)->first();
        $idCliente = 0;

        $idCliente = $ventas->cliente_id;

        $cliente = Clientes::where('id', $idCliente)->first();
        //dd($cliente);

        $detallexVentas = DetalleVentas::where('venta_id', $ultimoID)
            ->join('productos', 'productos.id', '=', 'detalle_ventas.producto_id')
            ->select(
                'detalle_ventas.Cantidad',
                'detalle_ventas.Total',
                'productos.descripcion',
                'productos.precioVenta'

            )->get();

        return view('modulos.boucher', ['detallesxventas' => $detallexVentas, 'user' => $user, 'cliente' => $cliente, 'ventas' => $ventas]);
    }

    public function pdf()
    {
        date_default_timezone_set('America/Mexico_City');
        $user = Auth::user();
        
        $ultimaVenta = Ventas::latest()->first();
        //dd($ultimaVenta);

        $ultimoID = $ultimaVenta->id;

        
        $ventas = Ventas::where('id', $ultimoID)->first();
        $idCliente = 0;

        $idCliente = $ventas->cliente_id;

        $cliente = Clientes::where('id', $idCliente)->first();
        //dd($cliente);

        $detallexVentas = DetalleVentas::where('venta_id', $ultimoID)
            ->join('productos', 'productos.id', '=', 'detalle_ventas.producto_id')
            ->select(
                'detalle_ventas.Cantidad',
                'detalle_ventas.Total',
                'productos.descripcion',
                'productos.precioVenta'

            )->get();

        
        $t = date('d-m-Y h:i:s');
        //echo($categDatos);
        $pdf = Pdf::loadView('modulos.pdfBaucher',  ['detallesxventas' => $detallexVentas, 'user' => $user, 'cliente' => $cliente, 'ventas' => $ventas]);
        return $pdf->stream(); //Para previsualizar el pdf
        //return $pdf->download('Categorias.pdf');
    }//End pdf

   
}
