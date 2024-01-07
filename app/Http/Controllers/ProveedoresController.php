<?php

namespace App\Http\Controllers;

use App\Models\Proveedores; //Llamamos al Models llamado Categorías para que cargue el método
use App\Models\Estados; //Llamamos al Models llamado Estados para cargarlos en la categoría
use App\Models\Tenants; //llamamos al Models Tenants con quien tiene relación categorías
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ProveedoresController extends Controller
{
    //Metodo que llama la pagina view de categorias cargada de datos
    public function Proveedores()
    {

        $user = Auth::user();
        //obtener el tenant relacionado con el usuario
        $tenant = $user->tenant;
        //se define la relacion
        $proveegDatos = $tenant->proveedores;
        //trae todos los datos del estado
        $estados = Estados::all();

        return view('modulos.proveedores', compact('proveegDatos', 'estados', 'tenant'));
    }

    //Método para GUARDAR una Nueva Categoria en la base de datos
    public function GuardarProveedores(Request $request)
    {
        //Primero validamos los campos obligatorios
        // var_dump($request);die();
        $request->validate(
            [
                'NombreProveedor' => 'required',
                'CedulaJuridica' => 'required',
                'Pais' => 'required',
                'Provincia' => 'required',
                'Ciudad' => 'required',
                'Direccion' => 'required',
                'NombreContacto' => 'required',
                'CorreoContacto' => 'required',
                'TelefonoEmpresa' => 'required',
                'Whatsapp' => 'required',
                'Sitioweb' => 'required',
                'Facebook' => 'required',
                'Instagram' => 'required',
                'estado_id' => 'required',
                'tenants_id' => 'required'
            ]
        );
        //FORMA 3
        Proveedores::insert([
            'NombreProveedor' => $request->NombreProveedor,
            'CedulaJuridica' => $request->CedulaJuridica,
            'Pais' => $request->Pais,
            'Provincia' => $request->Provincia,
            'Ciudad' => $request->Ciudad,
            'Direccion' => $request->Direccion,
            'NombreContacto' => $request->NombreContacto,
            'CorreoContacto' => $request->CorreoContacto,
            'TelefonoEmpresa' => $request->TelefonoEmpresa,
            'Whatsapp' => $request->Whatsapp,
            'Sitioweb' => $request->Sitioweb,
            'Facebook' => $request->Facebook,
            'Instagram' => $request->Instagram,
            'estado_id' => $request->estado_id,
            'tenants_id' => $request->tenants_id
        ]);

        $notification = array(
            'message' => 'El proveedor se guardó con éxito',
            'alert-type' => 'success'
        );
        return redirect()->route('modulos.proveedores')->with($notification);
    } // End Method

    //Método que nos hace obtener el id de la categoria que deseamos actualizar o modificar
    public function EditarProveedor($id)
    {
        $proveegDatos = Proveedores::findOrFail($id);
        return response()->json($proveegDatos);
    } // End Method

    //Metodo que llama el modal para editar o actualizar datos de categorias
    public function ModificarProveedores(Request $request)
    {
        /*Este valor viene de la variable editarID que esta 
        en el script del Json en el view para Editar */
        $id = $request->id;
        //var_dump($id); die();
        //var_dump($request); die();
        /** Forma 2 de como hacerlo */
        $data = Proveedores::find($id);
        //var_dump($id); die();

        $data->NombreProveedor = $request->NombreProveedor;
        $data->CedulaJuridica = $request->CedulaJuridica;
        $data->Pais = $request->Pais;
        $data->Provincia = $request->Provincia;
        $data->Ciudad = $request->Ciudad;
        $data->Direccion = $request->Direccion;
        $data->NombreContacto = $request->NombreContacto;
        $data->CorreoContacto = $request->CorreoContacto;
        $data->TelefonoEmpresa = $request->TelefonoEmpresa;
        $data->Whatsapp = $request->Whatsapp;
        $data->Sitioweb = $request->Sitioweb;
        $data->Facebook = $request->Facebook;
        $data->Instagram = $request->Instagram;
        $data->estado_id = $request->estado_id;
        $data->save();
        //var_dump($data); die();
        $notification = array(
            'message' => 'La categoria se actualizó con éxito',
            'alert-type' => 'success'
        );
        return redirect()->route('modulos.proveedores')->with($notification);
    } //end method

    public function EliminarProveedores($id)
    {
        Proveedores::findOrFail($id)->delete();
        $notification = array(
            'message' => 'el Proveedor se eliminó con éxito',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function pdf()
    {
        date_default_timezone_set('America/Mexico_City');
        $user = Auth::user();
        //obtener el tenant relacionado con el usuario
        $tenant = $user->tenant;
        //se define la relacion
        $proveegDatos = $tenant->proveedores;
        //trae todos los datos del estado
        $estados = Estados::all();
        $t = date('d-m-Y h:i:s');
        //echo($categDatos);

        $pdf = Pdf::loadView('modulos.pdfProveedores', compact('proveegDatos', 'estados', 'tenant', 't'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream(); //Para previsualizar el pdf
        //return $pdf->download('Categorias.pdf');
    } //End pdf

    public function excel()
    {
        $user = Auth::user();
        //obtener el tenant relacionado con el usuario
        $tenant = $user->tenant;
        //se define la relacion
        $proveegDatos = $tenant->proveedores;
        //trae todos los datos del estado
        $estados = Estados::all();

        $contenido = '<table>
                        <thead>
                            <tr>
                            <th>Id</th>
                            <th>Nombre Proveedor</th>
                            <th>Cédula Juridica</th>
                            <th>País</th>
                            <th>Provincia</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th>Nombre Contacto</th>
                            <th>Correo Contacto</th>
                            <th>Telefono Empresa</th>
                            <th>WhatsApp</th>
                            <th>Sitio Web</th>
                            <th>Facebook</th>
                            <th>Instagram</th>
                            <th>Estado</th>
                            <th>Id Tenant</th>
                            </tr>
                        </thead>
                        <tbody>';
        $i = 1;
        // compact('prodDatos', 'tenant', 'proveedores', 'categorias', 'estados'));
        foreach ($proveegDatos as $item) {
            foreach ($estados as $estado) {
                        if ($item->estado_id == $estado->id) {
                            //echo($producto->estado_id. "  = ".$estado-> id . " Nombre ".$estado->NombreEstado. " Fin ");
                            $contenido .= '<tr>
                    <td>' . $item->id . '</td>
                    <td>' . $item->NombreProveedor . '</td>
                    <td>' . $item->CedulaJuridica . '</td>
                    <td>' . $item->Pais . '</td>
                    <td>' . $item->Provincia . '</td>
                    <td>' . $item->Ciudad . '</td>
                    <td>' . $item->Direccion . '</td>
                    <td>' . $item->NombreContacto . '</td>
                    <td>' . $item->CorreoContacto . '</td>
                    <td>' . $item->TelefonoEmpresa . '</td>
                    <td>' . $item->Whatsapp . '</td>
                    <td>' . $item->Sitioweb . '</td>
                    <td>' . $item->Facebook . '</td>
                    <td>' . $item->Instagram . '</td>
                    <td>' . $estado->NombreEstado . '</td>
                    <td>' . $item->tenants_id . '</td>
                </tr>';
                        } //End if
            } //End proveedores
        } //End prodDatos
        $contenido .= '</tbody>
            </table>';

        // Establecer las cabeceras para descargar un archivo Excel
        $cabeceras = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename=Proveedores.xls',
            'Pragma' => 'no-cache',
            'Expires' => 0,
        ];
        // Devolver una respuesta con el contenido del archivo Excel
        return Response::make($contenido, 200, $cabeceras);
    }
}
