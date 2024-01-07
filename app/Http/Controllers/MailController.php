<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Categorias; //Llamamos al Models llamado Categorías para que cargue elmétodo
use App\Models\Estados; //Llamamos al Models llamado Estados para cargarlos en lacategoría
use App\Models\Tenants; //llamamos al Models Tenants con quien tiene relación categorías


use app\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class MailController extends Controller
{

       /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    
    public function send($vista)
    {
        

        $user = Auth::user();

        if($vista == "cat")
        {
            $tenant = $user->tenant;
            $categorias = $tenant->categorias;
            $datos = $categorias; 
            $route = 'modulos.categorias';
        }
        if($vista == "cli"){
            $tenant = $user->tenant;
            $clientes = $tenant->clientes;
            $datos = $clientes; 
            $route = 'modulos.clientes';
        }
        if($vista == "prv"){
            $tenant = $user->tenant;
            $proveedores = $tenant->proveedores;
            $datos = $proveedores; 
            $route = 'modulos.proveedores';
        }
        if($vista == "prd"){
            $tenant = $user->tenant;
            $productos = $tenant->productos;
            $datos = $productos; 
            $route = 'modulos.productos';
        }

        if($vista == "usu"){
            
            $id = Auth::user()->tenant->id;
             $usuarios = User::where('tenant_id', $id)->get();
            $datos = $usuarios; 
            $route = 'modulos.usuarios';
        }

        if($vista == "bit"){
            
            $id = Auth::user()->tenant->id;
             $usuarios = User::where('tenant_id', $id)->get();
            $datos = $usuarios; 
            $route = 'modulos.bitacoras';
        }



        $id = Auth::user()->id;
        $data = User::find($id);
        $emailDestino = $data->email;
        Mail::to($emailDestino)->send(new SendEmail($datos, $vista));
          
        $notification = array(
            'message' => 'Correo enviado con éxito a la direccion electrónica registrada: ' . $emailDestino ,
            'alert-type' => 'success'
            );
        return redirect()->route($route)->with($notification);
    }
    
    
}