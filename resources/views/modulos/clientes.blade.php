@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper" style="min-height: 1058.31px;">


    <!--

      <!- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Módulo Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio" style="color: blue;"><i class="nav-icon fas fa-home"></i>&nbsp;Inicio</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente" onclick="">

                        <b>Crear Cliente</b>

                    </button>
                </div>

                <br>

                <h3 class="card-title">Clientes Registradas</h3>

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
                        <form action="{{ route('clientes.excel') }}" method="post">
                            <a href="{{ route('clientes.excel') }}" type="submit" id="export_data" name="Exportexcel" class="btn btn-default buttons-excel buttons-html5 text-success" tabindex="0" aria-controls="user-group-list" type="button" title="Exportar a Excel"><span><i class="fa fa-file-excel"></i></span></a>
                        </form>

                        <a href="{{ route('clientes.pdf') }}" class="btn btn-default buttons-pdf buttons-html5 text-danger" tabindex="0" aria-controls="user-group-list" type="button" title=" Exportar a PDF"><span><i class="fa fa-file-pdf"></i></span></a>

                        <form action="{{ route('mail.send', 'cli') }}" method="post">
                            @csrf
                            <button id="email-btn" class="btn btn-default buttons-email text-primary" tabindex="0" aria-controls="invoice-invoice-list" type="submit" title="Email"><span><i class="fa fa-envelope"></i></span></button>
                        </form>
                    </div>
                </div>

                <br>

                <!-- /carga datos de la base de datos -->
                <table id="datatable" class="table table-bordered display responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        @if(sizeOf($clientDatos) != 0)
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
                            <th>Accion</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php($i = 1)

                        @foreach ($clientDatos as $item)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $item->idDocumento }} </td>
                            <td> {{ $item->NomCliente }} </td>
                            <td> {{ $item->CorreoCliente }} </td>
                            <td> {{ $item->TelefonoCliente }} </td>
                            <td> {{ $item->PaisCliente }} </td>
                            <td> {{ $item->ProvinciaCliente }} </td>
                            <td> {{ $item->DireccionCliente }} </td>
                            @if ($item->estado_id == 1)
                            <td>
                                <button class="btn btn-success btn-sm btnActivar">Activo</button>
                            </td>
                            @else
                            <td>
                                <button class="btn btn-danger btn-sm btnActivar">Inactivo</button>
                            </td>
                            @endif

                            <td>
                                <button type="button" class="btn btn-info sm" title="Editar Cliente" data-toggle="modal" data-target="#modalEditarCliente" id="{{ $item->id }}" onclick="editarCliente(this.id)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{ route('eliminar.clientes', $item->id) }}" class="btn btn-danger sm" title="Eliminar Cliente" id="delete"> <i class="fas fa-trash-alt"></i> </a>
                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                    @if(sizeOf($clientDatos) == 0)
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

<!--=====================================
        MODAL NUEVO Cliente
     ======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" action="{{ route('guardar.clientes') }}">
                @csrf
                <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

                <div class="modal-header" style="background:blue; color:white;">
                    <h4 class="modal-title">
                        <span class="fas fa-layer-group"></span> Agregar Cliente
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

                        <!-- ENTRADA PARA EL id documento -->

                        <div class="form-group">

                            <label for="inputDocumento" class="control-label">Id documento</label>

                            <div>
                                <input type="hidden" id="tenants_id" name="tenants_id" value="{{ $tenant->id }}">

                                <input name="idDocumento" id="idDocumento" class="form-control" type="text" value="" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group col-6">

                            <label for="inputName" class="control-label">Nombre del Cliente</label>

                            <div>
                                <input name="NomCliente" id="NomCliente" class="form-control" type="text" value="" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL correo -->

                        <div class="form-group col-6">

                            <label for="inputCorreo" class="control-label">Correo del Cliente</label>

                            <div>
                                <input name="CorreoCliente" id="CorreoCliente" class="form-control" type="text" value="" required>

                            </div>

                        </div>
                        <!-- ENTRADA PARA EL telefono -->

                        <div class="form-group col-6">

                            <label for="inputTelefono" class="control-label">Telefono del Cliente</label>

                            <div>
                                <input name="TelefonoCliente" id="TelefonoCliente" class="form-control" type="text" value="" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL pais -->

                        <div class="form-group col-6">

                            <label for="inputPais" class="control-label">Pais del Cliente</label>

                            <div>
                                <input name="PaisCliente" id="PaisCliente" class="form-control" type="text" value="" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL provincia -->

                        <div class="form-group col-6">

                            <label for="inputProvincia" class="control-label">Provincia del Cliente</label>

                            <div>
                                <input name="ProvinciaCliente" id="ProvinciaCliente" class="form-control" type="text" value="" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL direccion -->

                        <div class="form-group col-6">

                            <label for="inputDireccion" class="control-label">Direccion del Cliente</label>

                            <div>
                                <input name="DireccionCliente" id="DireccionCliente" class="form-control" type="text" value="" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA SELECCIONAR SU ESTADO -->

                        <div class="form-group col-6">

                            <label for="inputEstado" class="control-label">Estado</label>

                            <div>
                                <select class="form-select input-lg" name="estado_id" id="estado_id" required>

                                    <option value="">Selecionar Estado</option>
                                    @foreach ($estados as $data)
                                    <option value="{{ $data->id }}">{{ $data->NombreEstado }}</option>
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
                        <!--<button type="submit" class="btn btn-primary">Guardar Datos</button> -->
                        <input type="submit" class="btn btn-primary waves-effect waves-light" value="Guardar Datos">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div> <!-- FIN VENTANA MODAL CREAR Cliente -->


<!--=====================================
    MODAL EDITAR Cliente
    ======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" action="{{ route('modificar.clientes') }}">
                @csrf

                <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

                <div class="modal-header" style="background:#5955CC; color:white;">
                    <h4 class="modal-title">
                        <span class="fas fa-id-card"></span> Actualizar Datos de Cliente
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

                        <div class="form-group col">

                            <label for="inputName" class="control-label">id documento</label>

                            <div>
                                <input type="hidden" id="editarId" name="id">

                                <input type="hidden" id="editarTenant" name="tenants_id">

                                <input name="idDocumento" id="editarIdDocumento" class="form-control" type="text" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA CAMBIAR NOMBRE -->

                        <div class="form-group col-6">

                            <label for="inputName" class="control-label">Nombre del Cliente</label>

                            <div>

                                <input name="NomCliente" id="editarNombreCliente" class="form-control" type="text" required>

                            </div>

                        </div>


                        <!-- FIN NOMBRE-->

                        <!-- ENTRADA PARA CAMBIAR correo -->

                        <div class="form-group col-6">

                            <label for="inputName" class="control-label">Correo</label>

                            <div>

                                <input name="CorreoCliente" id="editarCorreoCliente" class="form-control" type="text" required>

                            </div>

                        </div>


                        <!-- FIN correo-->

                        <!-- ENTRADA PARA CAMBIAR telefono -->

                        <div class="form-group col-6">

                            <label for="inputName" class="control-label">Telefono</label>

                            <div>

                                <input name="TelefonoCliente" id="editarTelefonoCliente" class="form-control" type="text" required>

                            </div>

                        </div>


                        <!-- FIN telefono-->

                        <!-- ENTRADA PARA CAMBIAR pais -->

                        <div class="form-group col-6">

                            <label for="inputName" class="control-label">País</label>

                            <div>

                                <input name="PaisCliente" id="editarPaisCliente" class="form-control" type="text" required>

                            </div>

                        </div>


                        <!-- FIN pais-->

                        <!-- ENTRADA PARA CAMBIAR Provincia -->

                        <div class="form-group col-6">

                            <label for="inputName" class="control-label">Provincia</label>

                            <div>

                                <input name="ProvinciaCliente" id="editarProvinciaCliente" class="form-control" type="text" required>

                            </div>

                        </div>


                        <!-- FIN Provincia-->

                        <!-- ENTRADA PARA CAMBIAR NOMBRE -->

                        <div class="form-group col-6">

                            <label for="inputName" class="control-label">Dirección</label>

                            <div>

                                <input name="DireccionCliente" id="editarDireccionCliente" class="form-control" type="text" required>

                            </div>

                        </div>


                        <!-- FIN NOMBRE-->

                        <!-- ENTRADA PARA SELECCIONAR SU ESTADO -->

                        <div class="form-group col-6">

                            <label for="inputEstado" class="control-label">Cambia el estado</label>
                            <input type="hidden" id="editarEstado" name="estado_id">
                            <div>

                                <select class="form-select input-lg" name="estado_id" id="editarEstado" required>

                                    <option value="">Selecionar Estado</option>
                                    @foreach ($estados as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->NombreEstado }}
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
                        <button type="submit" class="btn btn-primary">Guardar Datos</button>
                        <!--<input type="submit" class="btn btn-primary waves-effect waves-light" value="Guardar Datos"> -->
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- CREAMOS UNA FUNCION JAVASCRIPT PARA EDITAR el cliente DESDE EL MODAL-->
<script type="text/javascript">
    //Funcion para editar el id
    function editarCliente(id) {
        $.ajax({
            type: 'GET',
            url: '/modulo/clientes/' + id,
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $('#editarId').val(data.id);
                $('#editarIdDocumento').val(data.idDocumento);
                $('#editarNombreCliente').val(data.NomCliente);
                $('#editarCorreoCliente').val(data.CorreoCliente);
                $('#editarTelefonoCliente').val(data.TelefonoCliente);
                $('#editarPaisCliente').val(data.PaisCliente);
                $('#editarProvinciaCliente').val(data.ProvinciaCliente);
                $('#editarDireccionCliente').val(data.DireccionCliente);
                $('#editarTenant').val(data.tenants_id);
                $('#editarEstado').val(data.estado_id);
                //$('#editarFecha').val(data.updated_at);
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

<!-- -------------------------------fin editar --------------------------------->


<!-------------------------------------------- MOSTRAR DATOS------------------------------------- -->
</div>