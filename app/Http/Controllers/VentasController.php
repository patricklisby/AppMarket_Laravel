<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Productos;
use App\Models\Ventas;
use App\Models\DetalleVentas;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class VentasController extends Controller
{
    public function Ventas()
    {
        // Asegurarse de que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect('/login');
        }

        $tenant = Auth::user()->tenant;
        $ventas = Ventas::where('tenant_id', $tenant->id)->get();
        $clientes = Clientes::all(); 

        $producto=Productos::where('tenants_id', $tenant->id)->get();
        $detalle = DetalleVentas::where('tenant_id', $tenant->id)->get();
    
        return view('modulos.ventas', [
            'ventas' => $ventas,
            'clientes' => $clientes,
            'tenants' => $tenant,
            'producto'=>$producto,
            'detalle'=>$detalle
        ]);
    }
    
    
    public function GuardarVentas(Request $request)
    {
        
        $ventaId = 0;
        $productos = $request->input('productos');
        $tenant = Auth::user()->tenant;
        $user = Auth::user();
        $id = $user->id;
    try {

        $ventaId = Ventas::insertGetId([
            'FechaVenta' => now(),
            'TipoVenta' => $productos[0]['tipoVenta'],
            'Subtotal' => $productos[0]['subtotal'],
            'Impuesto' => $productos[0]['impuesto'],
            'Descuento' => $productos[0]['descuento'],
            'TotalVentas' => $productos[0]['total'],
            'DescripcionVenta' => $productos[0]['descripcionVenta'],
            'usuario_id' => $id,
            'cliente_id' => $productos[0]['cliente'],
            'tenant_id' => $tenant->id
        ]);

        for($i = 0; $i < count($productos); $i++){
            DetalleVentas::insert([
                'Cantidad' => $productos[$i]['cantidad'],
                'Precio' => $productos[$i]['precio'],
                'Total' => $productos[$i]['total'],
                'venta_id' => $ventaId,
                'producto_id' => $productos[$i]['idProducto'],
                'tenant_id'=> $tenant->id
            ]);

            
            $producto = Productos::find($productos[$i]['idProducto']);
            $producto->stock -= $productos[$i]['cantidad'];
            $producto->save();
    }

    $response = 1;
} catch (Exception $error) {
    $response = 0;
}
//SE PUEDE DEVOLVER LOS DATOS NUEVAMENTE Y JALARLOS AL BOUCHER ruuuuuuuuuuuuuuuuuan
return response()->json(['message' => $ventaId]);
    }

    
}
