<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorias; //Llamamos al Models llamado Categorías para que cargue elmétodo
use App\Models\Estados; //Llamamos al Models llamado Estados para cargarlos en lacategoría
use App\Models\Tenants; //llamamos al Models Tenants con quien tiene relación categorías
use Illuminate\Support\Facades\Auth;
//Excel
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
//PDF
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Mockery\Undefined;

class CategoriasController extends Controller
{
    //metodo que lista la pagina view de categorias cargada de datos
    public function Categorias()
    {
        $user = Auth::user();
        //obtener el tenant relacionado con el usuario.
        $tenant = $user->tenant;
        $categDatos = $tenant->categorias;
        $estados = Estados::all();

        return view('modulos.categorias', compact('categDatos', 'estados', 'tenant'));
    }

    //Método para GUARDAR una Nueva Categoria en la base de datos
    public function GuardarCategoria(Request $request)
    {
        //Primero validamos los campos obligatorios
        $request->validate(
            [
                'nombrecategoria' => 'required',
                'tenants_id' => 'required',
                'estado_id' => 'required'
            ]
        );
        //FORMA 3
        Categorias::insert([
            'nombrecategoria' => $request->nombrecategoria,
            'estado_id' => $request->estado_id,
            'tenants_id' => $request->tenants_id,
            'created_at' => $request->created_at = now(),
        ]);
        $notification = array(
            'message' => 'La categoria se guardó con éxito',
            'alert-type' => 'success'
        );
        return redirect()->route('modulos.categorias')->with($notification);
    } // End Method

    //Método que nos hace obtener el id de la categoria que deseamos actualizar o modificar
    public function EditarCategoria($id)
    {
        $categDatos = Categorias::findOrFail($id);
        return response()->json($categDatos);
    } // End Method

    public function ModificarCategoria(Request $request)
    {
        $id = $request->id;

        $data = Categorias::find($id);
        $data->NombreCategoria = $request->NombreCategoria;
        $data->tenants_id = $request->tenants_id;
        $data->estado_id = $request->estado_id;
        $data->updated_at = $request->updated_at = now();
        $data->save();
        $notification = array(
            'message' => 'La categoria se actualizo correctamente',
            'alert-type' => 'success'
        );
        return redirect()->route('modulos.categorias')->with($notification);
    }

    public function EliminarCategoria($id)
    {
        Categorias::findOrFail($id)->delete();
        $notification = array(
            'message' => 'La categoria se elimino correctamente',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function pdf()
    {
        date_default_timezone_set('America/Mexico_City');
        $user = Auth::user();
        $tenant = $user->tenant;
        $categDatos = $tenant->categorias;
        $t = date('d-m-Y h:i:s');
        //echo($categDatos);
        $pdf = Pdf::loadView('modulos.pdfCategorias', compact('categDatos', 't'));
        return $pdf->stream(); //Para previsualizar el pdf
        //return $pdf->download('Categorias.pdf');
    }


    public function excel()
    {
        $datos = Categorias::all();
        $user = Auth::user();
        $tenant = $user->tenant;
        $categDatos = $tenant->categorias;
        $contenido = '';
        $estados = Estados::all();

        $contenido = '<table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>NombreCategoria</th>
                            <th>Estado</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($categDatos as $dato) {
             foreach ($estados as $estado) {
            if ($dato->estado_id == $estado->id) {
            $contenido .= '<tr>
            <td>' . $dato->id . '</td>
            <td>' . $dato->NombreCategoria . '</td>
            <td>' . $estado->NombreEstado . '</td>
            <td>' . $dato->created_at . '</td>
            <td>' . $dato->updated_at . '</td>
        </tr>';
          }
     }
    }

        $contenido .= '</tbody>
        </table>';
       // die($contenido);

        // Establecer las cabeceras para descargar un archivo Excel
        $cabeceras = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename=Categorias.xls',
            'Pragma' => 'no-cache',
            'Expires' => 0,
        ];

        // Devolver una respuesta con el contenido del archivo Excel
        return Response::make($contenido, 200, $cabeceras);
    }
    //Nuevo
    public function excel2()
    {
        $user = Auth::user();
        //obtener el tenant relacionado con el usuario.
        $tenant = $user->tenant;
        $categDatos = $tenant->categorias;
        $estados = Estados::all();

        $contenido = '';
        //Solo funciona con XLS 
        $contenido = '<table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>NombreCategoria</th>
                            <th>estado_id</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                            </tr>
                            </thead>
                            <tbody>';
        foreach ($categDatos as $dato) {
            foreach ($estados as $estado) {
                if ($dato->estado_id == $estado->id) {
                    $contenido .= ' <tr>
        <th>' . $dato->id . '</th>
        <th>' . $dato->NombreCategoria . '</th>
        <th>' . $dato->created_at . '</th>
        <th>' . $estado->NombreEstado . '</th>
        <th>' . $dato->updated_at . '</th>
        </tr>';
                }
            }
            $contenido .= '</tbody>
        </table>';

            // Establecer las cabeceras para descargar un archivo Excel
            $cabeceras = [
                'Content-Type' => 'application/vnd.ms-excel',
                'Content-Disposition' => 'attachment; filename=Categorias.xls',
                'Pragma' => 'no-cache',
                'Expires' => 0,
            ];
            // Devolver una respuesta con el contenido del archivo Excel
            return Response::make($contenido, 200, $cabeceras);
        } //End Excel
    }
}
