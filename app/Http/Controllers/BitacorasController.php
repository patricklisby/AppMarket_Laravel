<?php

namespace App\Http\Controllers;

use App\Models\Bitacoras;
use App\Models\Estados;
use App\Models\Tenants;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
//PDF
use Barryvdh\DomPDF\Facade\Pdf;


class BitacorasController extends Controller
{
    //metodo que lista la pagina view de categorias cargada de datos
    public function Bitacoras(){
        //$user = Auth::user();
        //obtener el tenant relacionado con el usuario.
       // $tenant = $user->tenant;

       $id = Auth::user()->tenant->id;
       $usuarios = User::where('tenant_id', $id)->get();
       //var_dump($usuarios); die();
        
       
        return view('modulos.bitacoras',compact('usuarios'));
    }
    //Listo
    public function pdf()
    {
        date_default_timezone_set('America/Mexico_City');

        $id = Auth::user()->tenant->id;
        $usuarios = User::where('tenant_id', $id)->get();
        $t = date('d-m-Y h:i:s');
        //echo($categDatos);
        $pdf = Pdf::loadView('modulos.pdfBitacoras', compact('usuarios', 't'));
        return $pdf->stream(); //Para previsualizar el pdf
        //return $pdf->download('Categorias.pdf');
    }

    //
    public function excel()
    {
        
       $id = Auth::user()->tenant->id;
       $usuarios = User::where('tenant_id', $id)->get();
        $contenido = '';
        //Solo funciona con XLS 
        $contenido = '<table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Correo electronico</th>
                            <th>Fecha Ingreso</th>
                            <th>Fecha Cierre</th>
                            <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody>';
        foreach ($usuarios as $dato) {
            if(Auth::check() && Auth::user()->id == $dato->id){
            $contenido .= ' <tr>
        <th>' . $dato->id . '</th>
        <th>' . $dato->email . '</th>
        <th>' . $dato->fechaIngreso . '</th>
        <th>' . $dato->fechaCierre . '</th>
        <th>Activo</th>
        </tr>';
            }else {
                $contenido .= ' <tr>
                <th>' . $dato->id . '</th>
                <th>' . $dato->email . '</th>
                <th>' . $dato->fechaIngreso . '</th>
                <th>' . $dato->fechaCierre . '</th>
                <th>Inactivo</th>
                </tr>';
            }
        }
        $contenido .= '</tbody>
        </table>';

        // Establecer las cabeceras para descargar un archivo Excel
        $cabeceras = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename=Bitacora.xls',
            'Pragma' => 'no-cache',
            'Expires' => 0,
        ];
        // Devolver una respuesta con el contenido del archivo Excel
        return Response::make($contenido, 200, $cabeceras);
    }
}
