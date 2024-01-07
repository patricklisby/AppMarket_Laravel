<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; //Llamamos al Models llamado Categorías para que cargue elmétodo
use App\Models\Estados; //Llamamos al Models llamado Estados para cargarlos en lacategoría
use App\Models\Tenants; //llamamos al Models Tenants con quien tiene relación categorías
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
//PDF
use Barryvdh\DomPDF\Facade\Pdf;


class UsuariosController extends Controller
{

    //metodo que lista la pagina view de categorias cargada de datos
    public function User()
    {
        $id = Auth::user()->tenant->id;
        $usuarios = User::where('tenant_id', $id)->get();
        $estados = Estados::all();

        return view('modulos.usuarios', compact('usuarios', 'estados'));
    }

    //Método para GUARDAR una Nueva Categoria en la base de datos
    public function GuardarUsuario(Request $request)
    {
        //Primero validamos los campos obligatorios
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'tenant_id' => 'required',
                'estado_id' => 'required',
                'perfil' => 'required'
            ]
        );
        //FORMA 3
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $request->email_verified_ad = now(),
            'password' => Hash::make($request->password),
            'created_at' => $request->created_at = now(),
            'updated_at' => $request->updated_at = now(),
            'tenant_id' => $request->tenant_id,
            'estado_id' => $request->estado_id,
            'perfil' => $request->perfil,

            // 'created_at' => $request->created_at = now(),
        ]);
        $notification = array(
            'message' => 'El usuario se guardó con éxito',
            'alert-type' => 'success'
        );
        return redirect()->route('modulos.usuarios')->with($notification);
    } // End Method

    //Método que nos hace obtener el id de la categoria que deseamos actualizar o modificar
    public function EditarUsuario($id)
    {
        $usuarios = User::findOrFail($id);
        return response()->json($usuarios);
    } // End Method

    public function ModificarUsuario(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);

        // Verificar si la contraseña actual es correcta
        if (Hash::check($request->contraseñaActual, $data->password)) {
            // La contraseña actual es correcta, proceder con la modificación

            $data->fill($request->only(['name', 'email', 'estado_id']));

            // Verificar si se proporcionó una nueva contraseña
            if ($request->filled('new_password')) {
                // Se proporcionó una nueva contraseña, actualizarla
                $data->password = Hash::make($request->contraseñaNueva);
            }

            $data->save();

            return redirect()->route('modulos.usuarios')->with([
                'message' => 'El usuario se actualizó correctamente',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('modulos.usuarios')->with([
            'message' => 'La contraseña actual es incorrecta',
            'alert-type' => 'error'
        ]);
    }


    public function EliminarUsuario($id)
    {
        User::findOrFail($id)->delete();
        $notification = array(
            'message' => 'El usuario se elimino correctamente',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function pdf()
    {
        date_default_timezone_set('America/Mexico_City');
        $id = Auth::user()->tenant->id;
        $usuarios = User::where('tenant_id', $id)->get();
        $estados = Estados::all();
        $t = date('d-m-Y h:i:s');
        //echo($categDatos);
        $pdf = Pdf::loadView('modulos.pdfUsuarios', compact('usuarios', 'estados', 't'));
        return $pdf->stream(); //Para previsualizar el pdf
        //return $pdf->download('Categorias.pdf');
    }

    //
    public function excel()
    {

        $id = Auth::user()->tenant->id;
        $usuarios = User::where('tenant_id', $id)->get();
        $estados = Estados::all();
        $contenido = '';
        //Solo funciona con XLS 
        $contenido = '<table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre Usuario</th>
                            <th>Correo Electronico</th>
                            <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody>';
        foreach ($usuarios as $dato) {
            if ($dato->estado_id == 1) {
                $contenido .= ' <tr>
        <th>' . $dato->id . '</th>
        <th>' . $dato->name . '</th>
        <th>' . $dato->email . '</th>
        <th>Activo</th>
        </tr>';
            } else {
                $contenido .= ' <tr>
                <th>' . $dato->id . '</th>
                <th>' . $dato->name . '</th>
                <th>' . $dato->email . '</th>
                <th>Inactivo</th>
                </tr>';
            }
        }
        $contenido .= '</tbody>
        </table>';

        // Establecer las cabeceras para descargar un archivo Excel
        $cabeceras = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename=Usuarios.xls',
            'Pragma' => 'no-cache',
            'Expires' => 0,
        ];
        // Devolver una respuesta con el contenido del archivo Excel
        return Response::make($contenido, 200, $cabeceras);
    }
}
