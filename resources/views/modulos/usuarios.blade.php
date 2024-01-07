@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper" style="min-height: 1058.31px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Módulo Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio" style="color: blue;"><i class="nav-icon fas fa-home"></i>&nbsp;Inicio</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

            <b>Crear Usuario</b>

          </button>
        </div>

        <br>

        <h3 class="card-title">Usuarios Registradas</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
        </div>

      </div>

      <div class="card-body">

        <div style="width: 100%; display: flex; justify-content: center;">
          <div class="dt-buttons btn-group" style="text-align: center;">
            <button class="btn btn-default buttons-print text-uppercase" tabindex="0" aria-controls="user-group-list" type="button" title="Imprimir" onclick="window.print();"><span><i class="fa fa-print"></i></span></button>

            <button onclick="copiarTabla()" class="btn btn-default buttons-copy buttons-html5 text-muted" tabindex="0" aria-controls="user-group-list" type="button" title="Copiar"><span><i class="fa fa-copy"></i></span></button>

            <!-- Es requerido -->
            <form action="{{ route('usuarios.excel') }}" method="post">
              <a href="{{ route('usuarios.excel') }}" type="submit" id="export_data" name="Exportexcel" class="btn btn-default buttons-excel buttons-html5 text-success" tabindex="0" aria-controls="user-group-list" type="button" title="Exportar a Excel"><span><i class="fa fa-file-excel"></i></span></a>
            </form>

            <a href="{{ route('usuarios.pdf') }}" class="btn btn-default buttons-pdf buttons-html5 text-danger" tabindex="0" aria-controls="user-group-list" type="button" title=" Exportar a PDF"><span><i class="fa fa-file-pdf"></i></span></a>

            <form action="{{ route('mail.send', 'usu') }}" method="post">
        @csrf
            <button id="email-btn" class="btn btn-default buttons-email text-primary" tabindex="0" aria-controls="invoice-invoice-list" type="submit" title="Email"><span><i class="fa fa-envelope"></i></span></button>
            </form>
          </div>
        </div>

        <br>

        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>Id</th>
              <th>name</th>
              <th>email</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>

            @php($i = 1)
            @foreach($usuarios as $item)
            <tr>
              <td> {{ $i++}} </td>
              <td> {{ $item->name}} </td>
              <td> {{ $item->email}} </td>


              @if($item->estado_id == 1)
              <td>
                <button class="btn btn-success btn-sm btnActivar">Activo</button>
              </td>
              @else
              <td>
                <button class="btn btn-danger btn-sm btnActivar">Inactivo</button>
              </td>
              @endif
              <td>
                <button type="button" class="btn btn-info sm" title="Editar Usuario" data-toggle="modal" data-target="#modalEditarUsuario" id="{{
                    $item->id }}" onclick="editarUsuario(this.id)">
                  <i class="fas fa-edit"></i>
                </button>
                <a href="{{ route('eliminar.usuario', $item->id) }}" class="btn btn-danger sm" title="Eliminar Usuario" id="delete"> <i class="fas
                    fa-trash-alt"></i> </a>
              </td>
            </tr>
            @endforeach


          </tbody>
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
              MODAL NUEVA CATEGORIA
              ======================================-->


<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" action="{{ route('guardar.usuario') }}">
        @csrf
        <!--=====================================
                      CABEZA DEL MODAL
                      ======================================-->

        <div class="modal-header" style="background:blue; color:white;">
          <h4 class="modal-title">
            <span class="fas fa-layer-group"></span> Agregar Usuario
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white;">&times;</span>
          </button>
        </div>

        <!--=====================================
                      CUERPO DEL MODAL
                      ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <label for="inputName" class="control-label">Nombre Usuario</label>

              <div>
                <input type="hidden" id="tenants_id" name="tenants_id" value="{{ $item->id }}">

                <input name="name" id="name" class="form-control" type="text" value="" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL CORREO -->
            <div class="form-group">

              <label for="inputName" class="control-label">Correo</label>

              <div>
                <input type="hidden" id="email" name="email" value="{{ $item->email }}">

                <input name="email" id="email" class="form-control" type="text" value="" required>

              </div>

            </div>
            <!-- ENTRADA PARA LA CONTRASEÑA -->
            <div class="form-group">

              <label for="inputName" class="control-label">Contraseña</label>

              <div>
                <input type="hidden" id="password" name="password" value="{{ $item->password }}">

                <input name="password" id="password" class="form-control" type="text" value="" required>

              </div>

            </div>
            <!-- ENTRADA PARA SELECCIONAR EL ID DEL TENANT -->
            <div class="form-group">


              <div>
                <input type="hidden" id="tenant_id" name="tenant_id" value="{{ $item->tenant_id }}">
              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EL PERFIL -->
            <div class="form-group">

              <label for="inputName" class="control-label">Perfil</label>

              <div>
                <input type="hidden" id="perfil" name="perfil" value="{{ $item->perfil }}">

                <input name="perfil" id="perfil" class="form-control" type="text" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EL ESTADO -->

            <div class="form-group">

              <label for="inputEstado" class="control-label">Estado</label>

              <div>

                <select class="form-select input-lg" name="estado_id" id="estado_id" required>

                  <option value="">Selecionar Estado</option>
                  @foreach($estados as $data)
                  <option value="{{$data->id}}">{{$data->NombreEstado}}</option>
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

</div> <!-- FIN VENTANA MODAL CREAR CATEGORIA -->






<!--=====================================
MODAL EDITAR CATEGORIA
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" action="{{ route('modificar.usuario') }}">
        @csrf

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#5955CC; color:white;">
          <h4 class="modal-title">
            <span class="fas fa-id-card"></span> Actualizar Datos de Usuario
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white;">&times;</span>
          </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <label for="inputName" class="control-label">Nombre Usuario</label>

              <div>
                <input type="hidden" id="editarId" name="id">

                <input type="hidden" id="editarTenant" name="tenants_id">

                <input name="name" id="editarNombre" class="form-control" type="text" required>

              </div>

            </div>

            <div class="form-group">

              <label for="inputName" class="control-label">Correo</label>

              <div>
                <input name="email" id="editarCorreo" class="form-control" type="text" required>

              </div>

            </div>

            <div class="form-group">

              <label for="inputName" class="control-label">Contraseña actual</label>

              <div>
                <input name="contraseñaActual" id="contraseñaActual" class="form-control" type="password" required>
              </div>

            </div>

            <div class="form-group">

              <label for="inputName" class="control-label">Contraseña nueva</label>

              <div>

                <input name="contraseñaNueva" id="contraseñaNueva" class="form-control" type="password" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU ESTADO -->

            <div class="form-group">

              <label for="inputEstado" class="control-label">Estado</label>
              <input type="hidden" id="editarEstado" name="estado_id">
              <div>

                <select class="form-select input-lg" name="estado_id" id="editarEstado" required>

                  <option value="">Selecionar Estado</option>
                  @foreach($estados as $data)
                  <option value="{{$data->id}}" @if ($data->id == $item->estado_id) {{ 'selected' }} @endif> {{$data->NombreEstado}} </option>
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

<!-- CREAMOS UNA FUNCION JAVASCRIPT PARA EDITAR LA CATEGORIA DESDE EL MODAL-->
<script type="text/javascript">
  //Funcion para editar el id
  function editarUsuario(id) {
    $.ajax({
      type: 'GET',
      url: '/modulo/usuarios/' + id,
      dataType: 'json',
      success: function(data) {
        //console.log(data)
        $('#editarId').val(data.id);
        $('#editarNombre').val(data.name);
        $('#editarCorreo').val(data.email);
        //   $('#editarFecha').val(data.updated_at);
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