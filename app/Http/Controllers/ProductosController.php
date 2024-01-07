<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Categorias; //Llamamos al Models llamado Categorías para que cargue elmétodo
use App\Models\Productos; //Llamamos al Models llamado Categorías para que cargue elmétodo
use App\Models\Estados; //Llamamos al Models llamado Estados para cargarlos en lacategoría
use App\Models\Proveedores;
use App\Models\Tenants; //llamamos al Models Tenants con quien tiene relación categorías
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Psr7\Query;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\StreamedResponse;

//Excel
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductosController extends Controller
{

    public function Productos()
    {
        $user = Auth::user();
        //obtener el tenant relacionado con el usuario.
        $tenant = $user->tenant; //Si

        $prodDatos = $tenant->productos;

        //echo $prodDatos;
        //echo $tenant;
        $proveedores =  $tenant->proveedores;
        $categorias = $tenant->categorias;
        $estados = Estados::all();

        //echo $tenant;

        return view('modulos.productos', compact('prodDatos', 'tenant', 'proveedores', 'categorias', 'estados'));
        // return view('modulos.productos');
    }

    //Método para GUARDAR una Nueva Categoria en la base de datos
    public function GuardarProductos(Request $request)
    {
        //Primero validamos los campos obligatorios
        $request->validate(
            [
                'codigoBarras' => 'required',
                'tenants_id' => 'required',
                'descripcion' => 'required',
                'precioCompra' => 'required',
                'precioVenta' => 'required',
                'utilidad' => 'required',
                'stock' => 'required',
                'ventas' => 'required',
                'categoria_id' => 'required',
                'existencia' => 'required',
                'proveedor_id' => 'required',
                'estado_id' => 'required'
            ]
        );
        //FORMA 3
        Productos::insert([
            'codigoBarras' => $request->codigoBarras,
            'tenants_id' => $request->tenants_id,
            'descripcion' => $request->descripcion,
            'precioCompra' => $request->precioCompra,
            'precioVenta' => $request->precioVenta,
            'utilidad' => $request->utilidad,
            'stock' => $request->stock,
            'ventas' => $request->ventas,
            'categoria_id' => $request->categoria_id,
            'proveedor_id' => $request->proveedor_id,
            'existencia' => $request->existencia,
            'estado_id' => $request->estado_id,
            'fechaIngreso' => $request->created_at = now(),
        ]);
        $notification = array(
            'message' => 'El producto se guardó con éxito',
            'alert-type' => 'success'
        );
        return redirect()->route('modulos.productos')->with($notification);
    } // End Method


    public function EditarProductos($id)
    {
        $prodDatos = Productos::findOrFail($id);
        return response()->json($prodDatos);
    }

    public function ModificarProductos(Request $request)
    {
        $id = $request->id;

        $data = Productos::find($id);
        $data->tenants_id = $request->tenants_id;
        $data->codigoBarras = $request->codigoBarras;
        $data->descripcion = $request->descripcion;
        $data->precioCompra = $request->precioCompra;
        $data->precioVenta = $request->precioVenta;
        $data->utilidad = $request->utilidad;
        $data->stock = $request->stock;
        $data->ventas = $request->ventas;
        $data->categoria_id = $request->categoria_id;
        $data->proveedor_id = $request->proveedor_id;
        $data->existencia = $request->existencia;
        $data->estado_id = $request->estado_id;
        //$data->fechaIngreso  = $request->created_at = now();
        $data->save();
        $notification = array(
            'message' => 'El producto se actualizo correctamente',
            'alert-type' => 'success'
        );
        return redirect()->route('modulos.productos')->with($notification);
    }

    public function EliminarProductos($id)
    {
        Productos::findOrFail($id)->delete();
        $notification = array(
            'message' => 'El producto se elimino correctamente',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function pdf()
    {
        date_default_timezone_set('America/Mexico_City');
        $user = Auth::user();
        //obtener el tenant relacionado con el usuario.
        $tenant = $user->tenant; //Si


        $prodDatos = $tenant->productos;

        //echo $prodDatos;
        //echo $tenant;
        $proveedores =  $tenant->proveedores;
        $categorias = $tenant->categorias;
        $estados = Estados::all();
        $t = date('d-m-Y h:i:s');
        //echo($categDatos);
        $pdf = Pdf::loadView('modulos.pdfProductos', compact('prodDatos', 'tenant', 'proveedores', 'categorias', 'estados', 't'));
        $pdf ->setpaper('A4','landscape');
        return $pdf->stream(); //Para previsualizar el pdf
        //return $pdf->download('Categorias.pdf');
    }//End pdf

    public function excel()
    {   $user = Auth::user();
        //obtener el tenant relacionado con el usuario.
        $tenant = $user->tenant; //Si

        $prodDatos = $tenant->productos;

        //echo $prodDatos;
        //echo $tenant;
        $proveedores =  $tenant->proveedores;
        $categorias = $tenant->categorias;
        $estados = Estados::all();
    
        $contenido = '<table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Codigo Barras</th>
                                <th>Descripcion</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Utilidad</th>
                                <th>Existencia</th>
                                <th>Stock</th>
                                <th>Ventas</th>
                                <th>Estado</th>
                                <th>Tenant</th>
                                <th>Categoria</th>
                                <th>Proveedor</th>
                                <th>Fecha Ingreso</th>
                            </tr>
                        </thead>
                        <tbody>';
    // compact('prodDatos', 'tenant', 'proveedores', 'categorias', 'estados'));
        foreach ($prodDatos as $producto) {
            foreach($proveedores as $prov){
                foreach($categorias as $cate){
                    foreach($estados as $estado){
               if($producto->estado_id == $estado-> id && $producto -> categoria_id == $cate->id
               && $producto -> proveedor_id == $prov->id){
                //echo($producto->estado_id. "  = ".$estado-> id . " Nombre ".$estado->NombreEstado. " Fin ");
                $contenido .= '<tr>
                    <td>' . $producto->id . '</td>
                    <td>' . $producto->codigoBarras . '</td>
                    <td>' . $producto->descripcion . '</td>
                    <td>' . $producto->precioCompra . '</td>
                    <td>' . $producto->precioVenta . '</td>
                    <td>' . $producto->utilidad . '</td>
                    <td>' . $producto->existencia . '</td>
                    <td>' . $producto->stock . '</td>
                    <td>' . $producto->ventas . '</td>
                    <td>' . $estado->NombreEstado . '</td>
                    <td>' . $tenant->NombreTenant. '</td>
                    <td>' . $cate->NombreCategoria . '</td>
                    <td>' . $prov->NombreProveedor . '</td>
                    <td>' . $producto->fechaIngreso . '</td>
                </tr>';
               }//End if
                    }//End estados
                }//End categorias
            }//End proveedores
        }//End prodDatos
        $contenido .= '</tbody>
            </table>';
    
        // Establecer las cabeceras para descargar un archivo Excel
        $cabeceras = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename=Productos.xls',
            'Pragma' => 'no-cache',
            'Expires' => 0,
        ];
        // Devolver una respuesta con el contenido del archivo Excel
        return Response::make($contenido, 200, $cabeceras);
    }

    
    public function excel2()
    {
        $user = Auth::user();
        $tenant = $user->tenant;
        $productos = $tenant->productos;
    
        $contenido = '<table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Codigo Barras</th>
                                <th>Descripcion</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Utilidad</th>
                                <th>Existencia</th>
                                <th>Stock</th>
                                <th>Ventas</th>
                                <th>Estado</th>
                                <th>Tenant</th>
                                <th>Categoria</th>
                                <th>Proveedor</th>
                                <th>Fecha Ingreso</th>
                            </tr>
                        </thead>
                        <tbody>';
    
        foreach ($productos as $producto) {
            $estado = $producto->estado ? $producto->estado->nombre : ''; // Verificar si el estado existe
            $categoria = $producto->categoria ? $producto->categoria->nombre : ''; // Verificar si la categoría existe
            $proveedor = $producto->proveedor ? $producto->proveedor->nomProveedor : ''; // Verificar si el proveedor existe
    
            $contenido .= '<tr>
                <td>' . $producto->id . '</td>
                <td>' . $producto->codigoBarras . '</td>
                <td>' . $producto->descripcion . '</td>
                <td>' . $producto->precioCompra . '</td>
                <td>' . $producto->precioVenta . '</td>
                <td>' . $producto->utilidad . '</td>
                <td>' . $producto->existencia . '</td>
                <td>' . $producto->stock . '</td>
                <td>' . $producto->ventas . '</td>
                <td>' . $producto->estado_id . '</td>
                <td>' . $tenant->NombreTenant. '</td>
                <td>' . $producto->categoria_id . '</td>
                <td>' . $producto->proveedor_id . '</td>
                <td>' . $producto->fechaIngreso . '</td>
            </tr>';
        }
        $contenido .= '</tbody>
            </table>';
    
        // Establecer las cabeceras para descargar un archivo Excel
        $cabeceras = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename=Productos.xls',
            'Pragma' => 'no-cache',
            'Expires' => 0,
        ];
        // Devolver una respuesta con el contenido del archivo Excel
        return Response::make($contenido, 200, $cabeceras);
    }
    
    
}

