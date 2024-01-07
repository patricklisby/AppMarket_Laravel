@extends('admin.admin_master')
@section('admin')

  @php
    $id = Auth::user()->id;
    $adminData = App\Models\User::find($id);
  @endphp

<div class="content-wrapper" style="min-height: 1058.31px;">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
      
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrativo Bitacoras</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio" style="color: blue;"><i class="nav-icon fas fa-home"></i>&nbsp;Inicio</a></li>
              <li class="breadcrumb-item active">Bitacoras</li>
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
          <br>

        <h3 class="card-title">Bitacoras Registradas</h3>

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
         <form action="{{ route('bitacoras.excel') }}" method="post">
           <a href="{{ route('bitacoras.excel') }}" type="submit" id="export_data" name="Exportexcel" class="btn btn-default buttons-excel buttons-html5 text-success" tabindex="0" aria-controls="user-group-list" type="button" title="Exportar a Excel"><span><i class="fa fa-file-excel"></i></span></a>
         </form> 

         <a href="{{ route('bitacoras.pdf') }}" class="btn btn-default buttons-pdf buttons-html5 text-danger" tabindex="0" aria-controls="user-group-list" type="button" title=" Exportar a PDF"><span><i class="fa fa-file-pdf"></i></span></a>

         <form action="{{ route('mail.send', 'bit') }}" method="post">
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
              <th>Correo</th>
              <th>Fecha Ingreso</th>
              <th>Fecha Cierre</th>
              <th>Estado</th>
            </tr>
          </thead>
            <tbody>
               
            @foreach($usuarios as $item)
                <tr>
                  
                  <td> {{$item->id}} </td>

                  <td> {{$item->email}} </td>
              
                  <td>
                    {{$item->fechaIngreso}}
                  </td>
              
                  <td>
                    {{$item->fechaCierre}}
                  </td>
              
                  <td>
                    @if(Auth::check() && Auth::user()->id == $item->id)
                      <button class="btn btn-success btn-sm btnActivar">Activo</button>
                    @else
                      <button class="btn btn-danger btn-sm btnActivar">Inactivo</button>
                    @endif
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
<script>
   function copiarTabla() {
  // Obtiene la referencia de la tabla
  var tabla = document.getElementById('datatable');

  // Crea un rango de selección
  var rango = document.createRange();
  rango.selectNodeContents(tabla);

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
    for (var j = 0; j < fila.cells.length; j++) {
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





