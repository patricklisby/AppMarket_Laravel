@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper" style="min-height: 1058.31px;">

  <!-- Content Header (Page header) -->
  <section class="content-header"></section>

  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Módulo Productos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio" style="color: blue;">
              <i class="nav-icon fas fa-home"></i>&nbsp;Inicio</a></li>
          <li class="breadcrumb-item active">Productos</li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProductos">

            <b>Crear Productos</b>

          </button>
        </div>

        <br>

        <h3 class="card-title">Productos Registradas</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>


      </div>

      <div class="card-body table-responsive">

        <div style="width: 100%; display: flex; justify-content: center;">
          <div class="dt-buttons btn-group" style="text-align: center;">
            <button class="btn btn-default buttons-print text-uppercase" tabindex="0" aria-controls="user-group-list" type="button" title="Imprimir" onclick="window.print();">
              <span><i class="fa fa-print"></i></span></button>

            <button onclick="copiarTabla()" class="btn btn-default buttons-copy buttons-html5 text-muted" tabindex="0" aria-controls="user-group-list" type="button" title="Copiar"><span><i class="fa fa-copy"></i></span></button>

            <!-- Es requerido -->
            <form action="{{ route('productos.excel') }}" method="post">
              <a href="{{ route('productos.excel') }}" type="submit" id="export_data" name="Exportexcel" class="btn btn-default buttons-excel buttons-html5 text-success" tabindex="0" aria-controls="user-group-list" type="button" title="Exportar a Excel"><span><i class="fa fa-file-excel"></i></span></a>
            </form>

            <a href="{{ route('productos.pdf') }}" class="btn btn-default buttons-pdf buttons-html5 text-danger" tabindex="0" aria-controls="user-group-list" type="button" title=" Exportar a PDF"><span><i class="fa fa-file-pdf"></i></span></a>

            <form action="{{ route('mail.send', 'prd') }}" method="post">
        @csrf
            <button id="email-btn" class="btn btn-default buttons-email text-primary" tabindex="0" aria-controls="invoice-invoice-list" type="submit" title="Email">
              <span><i class="fa fa-envelope"></i></span></button>

              </form>
          </div>
        </div>

        <br>
        <table id="datatable" class="table table-striped display responsive nowrap text-center" style="width:100%">
          <thead>
            @php($i = 1)
            @if(sizeOf($prodDatos) == 0)
            <div class="rounded-pill mt-2 mb-3 bg-blue p-1 w-100 text-center">
              <h3>No hay Datos Disponibles para este Usuario</h3>
            </div>
            @else
            <tr>
              <th>Id</th>
              <th>Codigo Barras</th>
              <th>Descripcion</th>
              <th>Precio Compra</th>
              <th>Precio Venta</th>
              <th>Utilidad</th>
              <th>Existencia</th>
              <th>Stock</th>
              <th>Ventas</th>
              <th>Tenant</th>
              <th>Categoria</th>
              <th>Proveedor</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach($prodDatos as $item)
            <tr>
              <td> {{ $i++}} </td>
              <td> {{ $item->codigoBarras}} </td>
              <td> {{ $item->descripcion}} </td>
              <!----------------------------------------------------->
              @if( $item->precioCompra == null)
              <td class="text-danger">Datos No Disponibles</td>
              @else
              <td> {{$item->precioCompra}} </td>
              @endif
              <!----------------------------------------------------->
              @if( $item->precioVenta == null)
              <td class="text-danger">Datos No Disponibles</td>
              @else
              <td> {{$item->precioVenta}} </td>
              @endif
              <!----------------------------------------------------->
              <td> {{ $item->utilidad}} </td>
              <!----------------------------------------------------->
              @if( $item->existencia == null)
              <td class="text-danger">Datos No Disponibles</td>
              @else
              <td> {{$item->existencia}} </td>
              @endif
              <!----------------------------------------------------->
              <td> {{ $item->stock}} </td>
              <!----------------------------------------------------->
              @if( $item->ventas == null)
              <td class="text-danger">Datos No Disponibles</td>
              @else
              <td> {{$item->ventas}} </td>
              @endif
              <!----------------------------------------------------->
              @if($tenant->id == $item->tenants_id)
              <td>
                {{$tenant->NombreTenant}}
              </td>
              @endif
              <!----------------------------------------------------->
              @if($item->categorias->tenants_id == $tenant->id)
              <td>{{$item->categorias->NombreCategoria}}</td>
              @endif
              <!----------------------------------------------------->
              @if($item->proveedores->tenants_id == $tenant->id)
              <td>{{$item->proveedores->NombreProveedor}}</td>
              @endif
              <!----------------------------------------------------->
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
                <button type="button" class="btn btn-info sm" title="Editar Categoría" data-toggle="modal" data-target="#modalEditarProductos" id="{{ $item->id }}" onclick="editarProductos(this.id)">
                  <i class="fas fa-edit"></i>
                </button>

                <a href="{{ route('eliminar.productos', $item->id) }}" class="btn btn-danger sm" title="Eliminar productos" id="delete"> <i class="fas fa-trash-alt"></i> </a>

              </td>
            </tr>
            @endforeach
            @endif
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
    MODAL NUEVA PRODUCTO
 ======================================-->

<div id="modalAgregarProductos" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" action="{{ route('guardar.productos') }}">
        @csrf
        <!--=====================================
                      CABEZA DEL MODAL
                      ======================================-->

        <div class="modal-header" style="background:blue; color:white;">
          <h4 class="modal-title">
            <span class="fas fa-layer-group"></span> Agregar Productos
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
            <div class="row">
              <div class="col-md-6 mb-4 ">

                <label for="inputName" class="control-label">Codigo Barras</label>

                <div>
                  <input type="hidden" id="tenants_id" name="tenants_id" value="{{ $tenant->id }}">

                  <input name="codigoBarras" id="codigoBarras" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4">

                <label for="inputName" class="control-label">Descripcion</label>

                <div>
                  <input name="descripcion" id="descripcion" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4">

                <label for="inputName" class="control-label">Precio Compra</label>

                <div>
                  <input name="precioCompra" id="precioCompra" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4">

                <label for="inputName" class="control-label">Precio Venta</label>

                <div>
                  <input name="precioVenta" id="precioVenta" class="form-control" type="text" value="" required>

                </div>

              </div>


              <div class="col-md-6 mb-4 ">

                <label for="inputName" class="control-label">Utilidad</label>

                <div>
                  <input name="utilidad" id="utilidad" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4 ">

                <label for="inputName" class="control-label">Stock</label>

                <div>
                  <input name="stock" id="stock" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4 ">

                <label for="inputName" class="control-label">Ventas</label>

                <div>
                  <input name="ventas" id="ventas" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4 ">

                <label for="inputName" class="control-label">Existencia</label>

                <div>
                  <input name="existencia" id="existencia" class="form-control" type="text" value="" required>

                </div>

              </div>


              <!-- ENTRADA PARA SELECCIONAR SU Categoria-->

              <div class="col-md-6 mb-4 ">

                <label for="inputCategoria" class="control-label">Categoria</label>

                <div>

                  <select class="form-select input-lg" name="categoria_id" id="categoria_id" required>

                    <option value="">Selecionar Categoria</option>
                    @foreach($categorias as $data)
                    <option value="{{$data->id}}">{{$data->NombreCategoria}}</option>
                    @endforeach
                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA SELECCIONAR SU Proveedor-->

              <div class="col-md-6 mb-4 ">

                <label for="inputProveedor" class="control-label">Proveedor</label>

                <div>

                  <select class="form-select input-lg" name="proveedor_id" id="proveedor_id" required>

                    <option value="">Selecionar Proveedor</option>
                    @foreach($proveedores as $data)
                    <option value="{{$data->id}}">{{$data->NombreProveedor}}</option>
                    @endforeach
                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA SELECCIONAR SU ESTADO -->

              <div class="col-md-6 mb-4 ">

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



<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->
<div id="modalEditarProductos" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" action="{{ route('modificar.productos') }}">
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
            <div class="row">
              <div class="col-md-6 mb-4 ">

                <label for="inputName" class="control-label">Codigo Barras</label>

                <div>
                  <input type="hidden" id="editarid" name="id">

                  <input type="hidden" id="editartenant_id" name="tenants_id">

                  <input name="codigoBarras" id="editarcodigoBarras" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4">

                <label for="inputName" class="control-label">Descripcion</label>

                <div>
                  <input name="descripcion" id="editardescripcion" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4">

                <label for="inputName" class="control-label">Precio Compra</label>

                <div>
                  <input name="precioCompra" id="editarprecioCompra" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4">

                <label for="inputName" class="control-label">Precio Venta</label>

                <div>
                  <input name="precioVenta" id="editarprecioVenta" class="form-control" type="text" value="" required>

                </div>

              </div>


              <div class="col-md-6 mb-4 ">

                <label for="inputName" class="control-label">Utilidad</label>

                <div>
                  <input name="utilidad" id="editarutilidad" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4 ">

                <label for="inputName" class="control-label">Stock</label>

                <div>
                  <input name="stock" id="editarstock" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4 ">

                <label for="inputName" class="control-label">Ventas</label>

                <div>
                  <input name="ventas" id="editarventas" class="form-control" type="text" value="" required>

                </div>

              </div>

              <div class="col-md-6 mb-4 ">

                <label for="inputName" class="control-label">Existencia</label>

                <div>
                  <input name="existencia" id="editarexistencia" class="form-control" type="text" value="" required>

                </div>

              </div>


              <!-- ENTRADA PARA SELECCIONAR SU Categoria-->

              <div class="col-md-6 mb-4 ">

                <label for="inputCategoria" class="control-label">Categoria</label>

                <div>

                  <select class="form-select input-lg" name="categoria_id" id="editarcategoria_id" required>

                    <option value="">Selecionar Categoria</option>
                    @foreach($categorias as $data)
                    <option value="{{$data->id}}">{{$data->NombreCategoria}}</option>
                    @endforeach
                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA SELECCIONAR SU Proveedor-->

              <div class="col-md-6 mb-4 ">

                <label for="inputProveedor" class="control-label">Proveedor</label>

                <div>

                  <select class="form-select input-lg" name="proveedor_id" id="editarproveedor_id" required>

                    <option value="">Selecionar Proveedor</option>
                    @foreach($proveedores as $data)
                    <option value="{{$data->id}}">{{$data->NombreProveedor}}</option>
                    @endforeach
                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA SELECCIONAR SU ESTADO -->

              <div class="col-md-6 mb-4 ">

                <label for="inputEstado" class="control-label">Estado</label>

                <div>

                  <select class="form-select input-lg" name="estado_id" id="editarestado_id" required>

                    <option value="">Selecionar Estado</option>
                    @foreach($estados as $data)
                    <option value="{{$data->id}}">{{$data->NombreEstado}}</option>
                    @endforeach
                  </select>

                </div>

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




<!-- CREAMOS UNA FUNCION JAVASCRIPT PARA EDITAR LA PRODUCTO DESDE EL MODAL-->
<script type="text/javascript">
  //Funcion para editar el id
  function editarProductos(id) {
    $.ajax({
      type: 'GET',
      url: '/modulo/productos/' + id,
      dataType: 'json',
      success: function(data) {
        //console.log(data)
        $('#editarid').val(data.id);
        $('#editarcodigoBarras').val(data.codigoBarras);
        $('#editartenant_id').val(data.tenants_id);
        $('#editardescripcion').val(data.descripcion);
        $('#editarprecioCompra').val(data.precioCompra);
        $('#editarprecioVenta').val(data.precioVenta);
        $('#editarutilidad').val(data.utilidad);
        $('#editarstock').val(data.stock);
        $('#editarventas').val(data.ventas);
        $('#editarcategoria_id').val(data.categoria_id);
        $('#editarexistencia').val(data.existencia);
        $('#editarproveedor_id').val(data.proveedor_id);
        $('#editarcodigoBarras').val(data.codigoBarras);
        $('#editarestado_id').val(data.estado_id);
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