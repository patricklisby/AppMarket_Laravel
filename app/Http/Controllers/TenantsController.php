<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenants;
use app\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Estados;

class TenantsController extends Controller
{
    public function edit()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el tenant relacionado con el usuario
        $tenant = $user->tenant;
        $estados = Estados::all();

        //Modificar fecha de contrato del tenant
        $id = $tenant->id;
        $data = Tenants::find($id);
        $data->CorreoVerificado = $user->email_verified_at;
        $data->save();

        // echo $user->email_verified_at;
        return view('modulos.perfil_tienda', compact('tenant', 'estados'));
    }

    public function editarTenant(Request $request)
    {

        $user = Auth::user();

        // Obtener el tenant relacionado con el usuario
        $tenant = $user->tenant;
        $id = $tenant->id;
        $data = Tenants::find($id);
        $data->NombreTenant = $request->NombreTenant;
        $data->nombreTienda = $request->nombreTienda;
        $data->Direccion = $request->Direccion;
        $data->CorreoTenant = $request->CorreoTenant;
        $data->Telefono = $request->Telefono;
        $data->Whatsapp = $request->Whatsapp;
        $data->FechaVencimiento = $request->FechaVencimiento;
        //$data->Logotipo = $request->Logotipo;
        $data->estado_id = $request->estado_id;
        $data->save();

        $notification = array(
            'message' => 'Los datos del perfil del tenant se actualizaron satisfactoriamente',
            'alert-type' => 'info'
        );
        return redirect()->route('tenant.edit')->with($notification);
    } // End Method


    public function StoreProfile(Request $request)
    {
        $id = Auth::user()->tenant->id;
        $data = Tenants::find($id);

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['Logotipo'] = $filename;
        }
        
        $data->save();

        $notification = array(
            'message' => 'La imagen del perfil se actualizó satisfactoriamente',
            'alert-type' => 'info'
        );

        return redirect()->route('tenant.edit')->with($notification);
    }
}
