<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tenants;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    /**
     * Se ingresa el tenant con el usuario, tomando los mismos datos.
     */
    public function store(Request $request): RedirectResponse
    //protected function store(array $data)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        //para sumarle un año a la fecha actual


        //Guardamos el Tenant Primero
        $tenant = Tenants::create([
            'NombreTenant' => $request->name,
            'CorreoTenant' => $request->email,
            'ClaveTenant' => Hash::make($request->password),
            'Perfil' => "User",
            'estado_id' => 1,
            'FechaContrato' => $request->FechaContrato = now(),
            'FechaVencimiento' => date('Y-m-d H:i:s', strtotime('+1 year', strtotime(now())))
            // 'created_at' => $request->created_at = now(),
            //'updated_at' => null,
        ]);
        //Luego creamos el usuario para ese Tenant
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tenant_id' => $tenant->id, //asignar el id del tenant al usuario
            'estado_id' => 1,
            'perfil' => "Admin",
        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
