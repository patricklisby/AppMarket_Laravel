<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Estados;
use App\Models\Tenants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientesController extends Controller
{
    //

    public function Clientes()
    {

        $user = Auth::user();

        //relacion de categoria con tenant
        $tenant = $user->tenant;
        $clientDatos = $tenant->clientes;
        $estados = Estados::all();

        return view('modulos.clientes', compact('clientDatos', 'estados', 'tenant',));
    } //listo


    //Método para GUARDAR una Nueva Categoria en la base de datos
    public function GuardarClientes(Request $request){
        //Primero validamos los campos obligatorios
        
        $request->validate(
        ['idDocumento'=>'required',
        'NomCliente'=>'required',
        'CorreoCliente'=>'required',
        'TelefonoCliente'=>'required',
        'PaisCliente'=>'required',
        'ProvinciaCliente'=>'required',
        'DireccionCliente'=>'required',
        'estado_id'=>'required',
        'tenants_id'=>'required']
        ); 
        //FORMA 3
        //dd($request);
        Clientes::insert([
        'idDocumento' => $request->idDocumento,
        'NomCliente' => $request->NomCliente,
        'CorreoCliente' => $request->CorreoCliente,
        'TelefonoCliente' => $request->TelefonoCliente,
        'PaisCliente' => $request->PaisCliente,
        'ProvinciaCliente' => $request->ProvinciaCliente,
        'DireccionCliente' => $request->DireccionCliente,
        'estado_id'=> $request->estado_id,
        'tenants_id' => $request->tenants_id,
        ]);
        $notification = array(
        'message' => 'El cliente se guardó con éxito',
        'alert-type' => 'success'
        ); 
        return redirect()->route('modulos.clientes')->with($notification);
    }// End Method


    //Método que nos hace obtener el id de la categoria que deseamos actualizar o modificar
    public function EditarCliente($id)
    {
        $categDatos = Clientes::findOrFail($id);
        return response()->json($categDatos);
    } // End Method



    public function ModificarCliente(Request $request)
    {
        $id = $request->id;
        #die($request->idDocumento);

        $data = Clientes::find($id);
        $data->idDocumento = $request->idDocumento;
        $data->NomCliente = $request->NomCliente;
        $data->CorreoCliente = $request->CorreoCliente;
        $data->TelefonoCliente = $request->TelefonoCliente;
        $data->PaisCliente = $request->PaisCliente;
        $data->ProvinciaCliente = $request->ProvinciaCliente;
        $data->DireccionCliente = $request->DireccionCliente;
        $data->tenants_id = $request->tenants_id;
        $data->estado_id = $request->estado_id;
        //$data->updated_at = $request->updated_at = now();
        echo $data;
        $data->save();


        $notification = array(
            'message' => 'el cliente se actualizó con exito',
            'alert-type' => 'succes'
        );
        return redirect()->route('modulos.clientes')->with($notification);
    }

    public function eliminarClientes($id)
    {
        Clientes::findOrFail($id)->delete();
        $notification = array(
            'message' => 'El cliente se eliminó con exito',
            'alert-type' => 'succes'
        );
        return redirect()->back()->with($notification);
    }

    public function pdf()
    {
        $user = Auth::user();

        //relacion de categoria con tenant
        $tenant = $user->tenant;
        $clientDatos = $tenant->clientes;
        $estados = Estados::all();

        $t = date('d-m-Y h:i:s');
        //echo($categDatos);

        $pdf = Pdf::loadView('modulos.pdfClientes', compact('clientDatos', 'estados', 'tenant', 't'));
        //$pdf->setPaper('A4', 'landscape');
        return $pdf->stream(); //Para previsualizar el pdf
        //return $pdf->download('Categorias.pdf');
    } //End pdf

    public function excel()
    {
        $user = Auth::user();

        //relacion de categoria con tenant
        $tenant = $user->tenant;
        $clientDatos = $tenant->clientes;
        $estados = Estados::all();

        $contenido = '<table>
                        <thead>
                            <tr>
                            <th>id</th>
                <th>id Documento</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>País</th>
                <th>Provincia</th>
                <th>Dirección</th>
                <th>estado</th>
                            </tr>
                        </thead>
                        <tbody>';
        $i = 1;
        // compact('prodDatos', 'tenant', 'proveedores', 'categorias', 'estados'));
        foreach ($clientDatos as $item) {
            foreach ($estados as $estado) {
                if ($item->estado_id == $estado->id) {
                    //die($item);
                    //echo($producto->estado_id. "  = ".$estado-> id . " Nombre ".$estado->NombreEstado. " Fin ");
                    $contenido .= '<tr>
                    <td>' . $item->id . '</td>
                    <td>' . $item->idDocumento . '</td>
                    <td>' . $item->NomCliente . '</td>
                    <td>' . $item->CorreoCliente . '</td>
                    <td>' . $item->TelefonoCliente . '</td>
                    <td>' . $item->PaisCliente . '</td>
                    <td>' . $item->ProvinciaCliente . '</td>
                    <td>' . $item->DireccionCliente . '</td>
                    <td>' . $estado->NombreEstado . '</td>
                </tr>';
                } //End if
            } //End proveedores
        } //End prodDatos
        $contenido .= '</tbody>
            </table>';

        // Establecer las cabeceras para descargar un archivo Excel
        $cabeceras = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename=Clientes.xls',
            'Pragma' => 'no-cache',
            'Expires' => 0,
        ];
        // Devolver una respuesta con el contenido del archivo Excel
        return Response::make($contenido, 200, $cabeceras);
    }
}
