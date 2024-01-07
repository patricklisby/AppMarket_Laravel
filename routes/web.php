<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantsController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BitacorasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\BaucherController;
use App\Http\Controllers\VentasController;
use App\Mail\EnvioCorreos;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/mail/send/{vista}', [MailController::class, 'send'])->name('mail.send');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'InfoDashboard'])->name('dashboard');
});
Route::get('/index/chart', [DashboardController::class, 'chartData']);

//TENANT CONTROLLER
Route::get('/tenant/edit', 'App\Http\Controllers\TenantsController@edit')->name('tenant.edit');

//CATEGORIAS CONTROLLER
Route::controller(CategoriasController::class)->group(function () {

    Route::get('/modulo/categorias/pdf', 'pdf')->name('categorias.pdf');
    Route::get('/modulo/categorias/copy', 'copy')->name('categorias.copy');
    Route::get('/modulo/categorias/excel', 'excel')->name('categorias.excel');

    //carga de Formulario
    Route::get('/modulo/categorias', 'Categorias')->name('modulos.categorias');
    Route::get('/modulo/categorias/{id}', 'EditarCategoria');
    //llamada de métodos
    Route::post('/guardar/categoria', 'GuardarCategoria')->name('guardar.categoria');
    Route::post('/modificar/categoria', 'ModificarCategoria')->name('modificar.categoria');
    Route::get('/eliminar/categoria/{id}', 'EliminarCategoria')->name('eliminar.categoria');
});

Route::controller(BitacorasController::class)->group(function () {

    Route::get('/modulo/bitacoras/pdf', 'pdf')->name('bitacoras.pdf');
    Route::get('/modulo/bitacoras/copy', 'copy')->name('bitacoras.copy');
    Route::get('/modulo/bitacoras/excel', 'excel')->name('bitacoras.excel');

    //carga de Formulario
    Route::get('/modulo/bitacoras', 'Bitacoras')->name('modulos.bitacoras');
});


Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');
    Route::post('/changedata/profile', 'ChangeProfileData')->name('changedata.profile');
    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

Route::controller(UsuariosController::class)->group(function () {
    Route::get('/modulo/usuarios/pdf', 'pdf')->name('usuarios.pdf');
    Route::get('/modulo/usuarios/copy', 'copy')->name('usuarios.copy');
    Route::get('/modulo/usuarios/excel', 'excel')->name('usuarios.excel');
    //carga de Formulario
    Route::get('/modulo/usuarios', 'User')->name('modulos.usuarios');
    Route::get('/modulo/usuarios/{id}', 'EditarUsuario');
    //llamada de métodos
    Route::post('/guardar/usuario', 'GuardarUsuario')->name('guardar.usuario');
    Route::post('/modificar/usuario', 'ModificarUsuario')->name('modificar.usuario');
    Route::get('/eliminar/usuario/{id}', 'EliminarUsuario')->name('eliminar.usuario');
});


Route::controller(BaucherController::class)->group(function () {
    Route::get('/modulo/baucher/pdf', 'pdf')->name('baucher.pdf');

    Route::get('/modulo/baucher', 'Baucher')->name('modulos.boucher');
});

Route::controller(VentasController::class)->group(function () {
    Route::get('/modulo/ventas', 'Ventas')->name('modulos.ventas');
    Route::post('/guardar/ventas', 'GuardarVentas')->name('guardar.ventas');
});


Route::controller(TenantsController::class)->group(function () {
    Route::post('/modulos/perfil_tienda_paraeditar.blade', 'editarTenant')->name('changedata.tenant');
    Route::post('/tenant/editImage', 'StoreProfile')->name('tenant.editImage');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Productos CONTROLLER
Route::controller(ProductosController::class)->group(function () {

    Route::get('/modulo/productos/pdf', 'pdf')->name('productos.pdf');
    Route::get('/modulo/productos/copy', 'copy')->name('productos.copy');
    Route::get('/modulo/productos/excel', 'excel')->name('productos.excel');
    //carga de Formulario
    Route::get('/modulo/productos', 'Productos')->name('modulos.productos'); //listo
    Route::get('/modulo/productos/{id}', 'EditarProductos'); //llamada de métodos
    Route::post('/guardar/productos', 'GuardarProductos')->name('guardar.productos'); //listo    
    Route::post('/modificar/productos', 'ModificarProductos')->name('modificar.productos'); //listo
    Route::get('/eliminar/prodcutos/{id}', 'EliminarProductos')->name('eliminar.productos');
});


//Nuevo

//clientes controller
Route::controller(ClientesController::class)->group(function () {
    Route::get('/modulo/clientes/pdf', 'pdf')->name('clientes.pdf');
    Route::get('/modulo/clientes/copy', 'copy')->name('clientes.copy');
    Route::get('/modulo/clientes/excel', 'excel')->name('clientes.excel');
    //carga de Formulario
    Route::get('/modulo/clientes', 'clientes')->name('modulos.clientes');
    Route::get('/modulo/clientes/{id}', 'EditarCliente');
    //llamada de métodos
    Route::post('/guardar/clientes', 'GuardarClientes')->name('guardar.clientes');
    Route::post('/modificar/clientes', 'ModificarCliente')->name('modificar.clientes');
    Route::get('/eliminar/clientes/{id}', 'eliminarClientes')->name('eliminar.clientes');
});

Route::controller(ProveedoresController::class)->group(function () {

    Route::get('/modulo/proveedores/pdf', 'pdf')->name('proveedores.pdf');
    Route::get('/modulo/proveedores/copy', 'copy')->name('proveedores.copy');
    Route::get('/modulo/proveedores/excel', 'excel')->name('proveedores.excel');
    //carga de Formulario
    Route::get('/modulo/proveedores', 'Proveedores')->name('modulos.proveedores');
    Route::get('/modulo/proveedores/{id}', 'EditarProveedor');
    //llamada de metodos
    Route::post('/guardar/proveedores', 'GuardarProveedores')->name('guardar.proveedores');
    Route::get('/eliminar/proveedores/{id}', 'EliminarProveedores')->name('eliminar.proveedores');
    Route::post('/modificar/proveedores', 'ModificarProveedores')->name('modificar.proveedores');
});


/*Route::get('/dashboard/chart', [ChartJSController::class, 'chartData']);

Route::controller(ChartJSController::class)->group(function(){
    Route::get('/dashboard/chart', 'chartData');
});*/

require __DIR__ . '/auth.php';
