<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="card">
      
      <div class="card-header">

        

        <h3 class="card-title" style="text-align:center;">Clientes Registrados</h3>

          </div>
        </div>
    
      <div style="text-align:center;">
      <table role="presentation" style="width:60%;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;margin: 0 auto!important;">
          <thead style="background-color: cornflowerblue;" >
            <tr style="color: #fff;border: 1px solid #eee" >
              <th style="width:260px;padding:0;vertical-align:top">Id</th>
              <th style="width:260px;padding:0;vertical-align:top;">Id Documento</th>
              <th style="width:260px;padding:0;vertical-align:top;">Correo</th>
              <th style="width:260px;padding:0;vertical-align:top;">Telefono</th>
              <th style="width:260px;padding:0;vertical-align:top;">País</th>
              <th style="width:260px;padding:0;vertical-align:top;">Provincia</th>
              <th style="width:260px;padding:0;vertical-align:top;">Direccion</th>
              <th style="width:260px;padding:0;vertical-align:top;">Estado</th>
            </tr>
          </thead>
            <tbody  >

            @php($i = 1)
              @foreach($datos as $cliente)
              <tr style="border: 1px solid #eee" >
                  <td>{{ $cliente->id}}</td>
                  <td>{{ $cliente->idDocumento}}</td>
                  <td>{{ $cliente->NomCliente}}</td>
                  <td>{{ $cliente->CorreoCliente}}</td>
                  <td>{{ $cliente->TelefonoCliente}}</td>
                  <td>{{ $cliente->PaisCliente}}</td>
                  <td>{{ $cliente->ProvinciaCliente}}</td>
                  <td>{{ $cliente->DireccionCliente}}</td>
              @if($cliente->estado_id == 1)
                  <td >
                   Activo
                  </td>
              @else
                  <td>
                 Inactivo 
                  </td>
              @endif
               
              </tr>
              @endforeach


            </tbody>
        </table>
      </div>
      <div class="container-fluid" style="padding-top: 25px; text-align: center;">
    <div class="col-sm-6">
        <strong>Copyright © 
            <script>document.write(new Date().getFullYear())</script>2023
            <a href="#">appMarket.com</a> 
        </strong>
   </div>
    Todos los derechos reservados
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0<br>
      Hecho por Estudiantes UCR
    </div>
     </div>

</body>
</html>