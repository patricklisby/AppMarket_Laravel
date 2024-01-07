@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper" style="min-height: 1058.31px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Módulo Proveedores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio" style="color: blue;"><i class="nav-icon fas fa-home"></i>&nbsp;Inicio</a></li>
                        <li class="breadcrumb-item active">Proveedores</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">

            <div class="card-header">

                <div class="box-header with-border">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">

                        <b>Crear Proveedores</b>

                    </button>
                </div>

                <br>

                <h3 class="card-title">Proveedores Registrados</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>

            </div>

            <div class="card-body">

                <div style="width: 100%; display: flex; justify-content: center;">
                    <div class="dt-buttons btn-group" style="text-align: center;">
                        <button class="btn btn-default buttons-print text-uppercase" tabindex="0" aria-controls="user-group-list" type="button" title="Imprimir" onclick="window.print();"><span><i class="fa fa-print"></i></span></button>


                        <button onclick="copiarTabla()" class="btn btn-default buttons-copy buttons-html5 text-muted" tabindex="0" aria-controls="user-group-list" type="button" title="Copiar"><span><i class="fa fa-copy"></i></span></button>

                        <!-- Es requerido -->
                        <form action="{{ route('proveedores.excel') }}" method="post">
                            <a href="{{ route('proveedores.excel') }}" type="submit" id="export_data" name="Exportexcel" class="btn btn-default buttons-excel buttons-html5 text-success" tabindex="0" aria-controls="user-group-list" type="button" title="Exportar a Excel"><span><i class="fa fa-file-excel"></i></span></a>
                        </form>

                        <a href="{{ route('proveedores.pdf') }}" class="btn btn-default buttons-pdf buttons-html5 text-danger" tabindex="0" aria-controls="user-group-list" type="button" title=" Exportar a PDF"><span><i class="fa fa-file-pdf"></i></span></a>

                        <form action="{{ route('mail.send', 'prv') }}" method="post">
                            @csrf
                            <button id="email-btn" class="btn btn-default buttons-email text-primary" tabindex="0" aria-controls="invoice-invoice-list" type="submit" title="Email"><span><i class="fa fa-envelope"></i></span></button>
                        </form>
                    </div>
                </div>

                <br>
                <table id="datatable" class="table table-bordered display responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        @if(sizeOf($proveegDatos) != 0)
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
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($proveegDatos as $item)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $item->NombreProveedor }} </td>
                            <td> {{ $item->CedulaJuridica }} </td>
                            <td> {{ $item->Pais }} </td>
                            <td> {{ $item->Provincia }} </td>
                            <td> {{ $item->Ciudad }} </td>
                            <td> {{ $item->Direccion }} </td>
                            <td> {{ $item->NombreContacto }} </td>
                            <td> {{ $item->CorreoContacto }} </td>
                            <td> {{ $item->TelefonoEmpresa }} </td>
                            <td> {{ $item->Whatsapp }} </td>
                            <td> {{ $item->Sitioweb }} </td>
                            <td> {{ $item->Facebook }} </td>
                            <td> {{ $item->Instagram }} </td>
                            @if ($item->estado_id == 1)
                            <td>
                                <button class="btn btn=success btn-sm btnActivar">Activo</button>
                            </td>
                            @else
                            <td>
                                <button class="btn btn-danger btn-sm btnActivar">Inactivo</button>
                            </td>
                            @endif
                            <td> {{ $item->tenants_id }} </td>
                            <td>
                                <button type="button" class="btn btn-info sm" title="Editar Proveedores" data-toggle="modal" data-target="#modalEditarProveedores" id="{{ $item->id }}" onclick="EditarProveedor(this.id)">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <a href="{{ route('eliminar.proveedores', $item->id) }}" class="btn btn-danger sm" title="Eliminar Categoría" id="delete">
                                    <i class="fas fa-trash-alt"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                    @if(sizeOf($proveegDatos) == 0)
                    <tr>
                        <div class="text-center bg-blue p-3 rounded-pill" style="color: ghostwhite;">
                            <h1>
                                No hay datos disponibles en este momento, ingrese uno.
                            </h1>
                        </div>
                    </tr>
                    @endif
                </table>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <!--Footer-->
            </div>
            <!-- /.card-footer-->

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

</div>

<div class="card-body">
    <div class="tab-content p-0">
        <!-- Morris chart - Sales -->
        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
        </div>
        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
        </div>
    </div>
</div><!-- /.card-body -->
</div>
<!-- /.card -->


<!--=====================================
        MODAL NUEVO PROVEEDOR
     ======================================-->

<div id="modalAgregarProveedor" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" action="{{ route('guardar.proveedores') }}">
                @csrf
                <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

                <div class="modal-header" style="background:blue; color:white;">
                    <h4 class="modal-title">
                        <span class="fas fa-layer-group"></span> Agregar Proveedor
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:white;">&times;</span>
                    </button>
                </div>

                <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

                <div class="modal-body">

                    <div class="box-body row">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <label for="NombreProveedor" class="control-label">Nombre Proveedor</label>
                            <div>
                                <input name="NombreProveedor" id="NombreProveedor" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="CedulaJuridica" class="control-label">Cédula Juridica</label>
                            <div>
                                <input name="CedulaJuridica" id="CedulaJuridica" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <!-- </div> -->

                        <div class="form-group col-6">
                            <label for="Pais" class="control-label">País</label>
                            <div>
                                <input name="Pais" id="Pais" class="form-control" type="text" value="" required>
                            </div>
                        </div>


                        <div class="form-group col-6">
                            <label for="Provincia" class="control-label">Provincia</label>
                            <div>
                                <input name="Provincia" id="Provincia" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Ciudad" class="control-label">Ciudad</label>
                            <div>
                                <input name="Ciudad" id="Ciudad" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Direccion" class="control-label">Dirección</label>
                            <div>
                                <input name="Direccion" id="Direccion" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="NombreContacto" class="control-label">Nombre Contacto</label>
                            <input name="NombreContacto" id="NombreContacto" class="form-control" type="text" value="" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="CorreoElectronico" class="control-label">Correo Contacto</label>
                            <div>
                                <input name="CorreoContacto" id="CorreoContacto" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="TelefonoEmpresa" class="control-label">Telefono Empresa</label>
                            <div>
                                <input name="TelefonoEmpresa" id="TelefonoEmpresa" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Whatsapp" class="control-label">WhatsApp</label>
                            <div>
                                <input name="Whatsapp" id="Whatsapp" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Sitioweb" class="control-label">Sitio Wed</label>
                            <div>
                                <input name="Sitioweb" id="Sitioweb" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Facebook" class="control-label">Facebook</label>
                            <div>
                                <input name="Facebook" id="Facebook" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Instagram" class="control-label">Instagram</label>
                            <div>
                                <input name="Instagram" id="Instagram" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA SELECCIONAR SU ESTADO -->

                        <div class="form-group">
                            <label for="inputEstado" class="control-label">Estado</label>
                            <div>
                                <select class="form-select form-select-lg" name="estado_id" id="estado_id" required>
                                    <option value="">Selecionar Estado</option>
                                    @foreach ($estados as $data)
                                    <option value="{{ $data->id }}">{{ $data->NombreEstado }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="tenants_id" name="tenants_id" value="{{ $tenant->id }}">
                            </div>
                        </div>

                    </div>
                </div>

                <!--=====================================
            PIE DEL MODAL
            ======================================-->
                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <!--<button type="submit" class="btn btn-primary">Guardar Datos</button> -->
                        <input type="submit" class="btn btn-primary waves-effect waves-light" value="Guardar Datos">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- FIN VENTANA MODAL CREAR CATEGORIA -->


<!--=====================================
    MODAL EDITAR Proveedor
    ======================================-->
<div id="modalEditarProveedores" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('modificar.proveedores') }}">
                @csrf

                <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

                <div class="modal-header" style="background:#5955CC; color:white;">
                    <h4 class="modal-title">
                        <span class="fas fa-layer-group"></span> Actualizar Datos del Proveedor
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:white;">&times;</span>
                    </button>
                </div>

                <!--=====================================
            CUERPO DEL MODAL
            ======================================-->
                <div class="modal-body">
                    <div class="box-body row">

                        <div class="form-group">
                            <label for="NombreProveedor" class="control-label">Nombre Proveedor</label>
                            <div>
                                <input type="hidden" id="editarId" name="id">
                                <!--  <input type="hidden" id="editarTenant" name="tenants_id">-->
                                <input name="NombreProveedor" id="editarNombreProveedor" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="CedulaJuridica" class="control-label">Cedula Juridica</label>
                            <div>
                                <input name="CedulaJuridica" id="editarCedulaJuridica" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Pais" class="control-label">País</label>
                            <div>
                                <input name="Pais" id="editarPais" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Provincia" class="control-label">Provincia</label>
                            <div>
                                <input name="Provincia" id="editarProvincia" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Ciudad" class="control-label">Ciudad</label>
                            <div>
                                <input name="Ciudad" id="editarCiudad" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Direccion" class="control-label">Dirección</label>
                            <div>
                                <input name="Direccion" id="editarDireccion" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="NombreContacto" class="control-label">Nombre Contacto</label>
                            <div>
                                <input name="NombreContacto" id="editarNombreContacto" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="CorreoContacto" class="control-label">Correo Contacto</label>
                            <div>
                                <input name="CorreoContacto" id="editarCorreoContacto" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="TelefonoEmpresa" class="control-label">Telefono Empresa</label>
                            <div>
                                <input name="TelefonoEmpresa" id="editarTelefonoEmpresa" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Whatsapp" class="control-label">WhatsApp</label>
                            <div>
                                <input name="Whatsapp" id="editarWhatsapp" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Sitioweb" class="control-label">Sitio Web</label>
                            <div>
                                <input name="Sitioweb" id="editarSitioweb" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Facebook" class="control-label">Facebook</label>
                            <div>
                                <input name="Facebook" id="editarFacebook" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="Instagram" class="control-label">Instagram</label>
                            <div>
                                <input name="Instagram" id="editarInstagram" class="form-control" type="text" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEstado" class="control-label">Estado</label>
                            <input type="hidden" id="editarEstado" name="estado_id">

                            <div>
                                <select class="form-select form-select-lg input-lg" name="estado_id" id="editarEstado" required>
                                    <option value="">Selecionar Estado</option>
                                    @foreach ($estados as $data)
                                    <option value="{{$data->id}}">
                                        {{$data->NombreEstado}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <!--=====================================
            PIE DEL MODAL
            ======================================-->
                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar Datos</button>
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<!-- CREAMOS UNA FUNCION JAVASCRIPT PARA EDITAR LA CATEGORIA DESDE EL MODAL-->
<script type="text/javascript">
    //Funcion para editar el id
    function EditarProveedor(id) {
        $.ajax({
            type: 'GET',
            url: '/modulo/proveedores/' + id,
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $('#editarId').val(data.id);
                $('#editarNombreProveedor').val(data.NombreProveedor);
                $('#editarCedulaJuridica').val(data.CedulaJuridica);
                $('#editarPais').val(data.Pais);
                $('#editarProvincia').val(data.Provincia);
                $('#editarCiudad').val(data.Ciudad);
                $('#editarDireccion').val(data.Direccion);
                $('#editarNombreContacto').val(data.NombreContacto);
                $('#editarCorreoContacto').val(data.CorreoContacto);
                $('#editarTelefonoEmpresa').val(data.TelefonoEmpresa);
                $('#editarWhatsapp').val(data.Whatsapp);
                $('#editarSitioweb').val(data.Sitioweb);
                $('#editarFacebook').val(data.Facebook);
                $('#editarInstagram').val(data.Instagram);
                $('#editarEstado').val(data.estado_id);
                $('#editarTenant').val(data.tenants_id);
            }
        })
    }

    function copiarTabla() {
        // Obtiene la referencia de la tabla
        var tabla = document.getElementById('datatable');

        // Crea un rango de selección
        var rango = document.createRange();
        var ultimaColumna = tabla.rows[0].cells.length - 1; // Índice de la última columna
        rango.selectNodeContents(tabla);

        // Excluye la última columna del rango
        var ultimaCelda = tabla.rows[0].cells[ultimaColumna];
        rango.setEndBefore(ultimaCelda);

        // Crea un objeto de selección
        var seleccion = window.getSelection();
        seleccion.removeAllRanges();
        seleccion.addRange(rango);

        // Copia los datos al portapapeles
        document.execCommand('copy');

        // Limpia la selección
        seleccion.removeAllRanges();

        // Copia los datos de la tabla en formato TSV
        var datosTabla = '';
        for (var i = 0; i < tabla.rows.length; i++) {
            var fila = tabla.rows[i];
            for (var j = 0; j < fila.cells.length - 1; j++) { // Omitir la última columna
                var celda = fila.cells[j];
                datosTabla += celda.innerText + '\t';
            }
            datosTabla = datosTabla.trim() + '\n';
        }

        // Copia los datos al portapapeles
        var input = document.createElement('textarea');
        input.value = datosTabla;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);

        // Muestra una notificación o realiza cualquier acción adicional
        alert('¡La tabla se ha copiado al portapapeles!');
    }
</script>
@endsection