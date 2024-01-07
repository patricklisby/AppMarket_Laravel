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

        

        <h3 class="card-title" style="text-align:center;">Proovedores Registrados</h3>

          </div>
        </div>
    
      <div style="text-align:center;">
      <table role="presentation" style="width:60%;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;margin: 0 auto!important;">
          <thead style="background-color: cornflowerblue;" >
            <tr style="color: #fff;border: 1px solid #eee" >
              <th style="width:260px;padding:0;vertical-align:top">Id</th>
              <th style="width:260px;padding:0;vertical-align:top;">Nombre Proveedor</th>
              <th style="width:260px;padding:0;vertical-align:top;">Cédula Juridica</th>
              <th style="width:260px;padding:0;vertical-align:top;">País</th>
              <th style="width:260px;padding:0;vertical-align:top;">Provincia</th>
              <th style="width:260px;padding:0;vertical-align:top;">Ciudad</th>
              <th style="width:260px;padding:0;vertical-align:top;">Direccion</th>
              <th style="width:260px;padding:0;vertical-align:top;">Nombre Contacto</th>
              <th style="width:260px;padding:0;vertical-align:top;">Correo Contacto</th>
              <th style="width:260px;padding:0;vertical-align:top;">Telefono Empresa</th>
              <th style="width:260px;padding:0;vertical-align:top;">WhatsApp</th>
              <th style="width:260px;padding:0;vertical-align:top;">Sitio Web</th>
              <th style="width:260px;padding:0;vertical-align:top;">Facebook</th>
              <th style="width:260px;padding:0;vertical-align:top;">Instagram</th>
              <th style="width:260px;padding:0;vertical-align:top;">Estado</th>
              <th style="width:260px;padding:0;vertical-align:top;">Id Tenant</th>
            </tr>
          </thead>
            <tbody  >

            @php($i = 1)
              @foreach($datos as $proveedor)
              <tr style="border: 1px solid #eee" >
                  <td>{{ $proveedor->id}}</td>
                  <td>{{ $proveedor->NombreProveedor}}</td>
                  <td>{{ $proveedor->CedulaJuridica}}</td>
                  <td>{{ $proveedor->Pais}}</td>
                  <td>{{ $proveedor->Provincia}}</td>
                  <td>{{ $proveedor->Ciudad}}</td>
                  <td>{{ $proveedor->Direccion}}</td>
                  <td>{{ $proveedor->NombreContacto}}</td>
                  <td>{{ $proveedor->CorreoContacto}}</td>
                  <td>{{ $proveedor->TelefonoEmpresa}}</td>
                  <td>{{ $proveedor->WhatsApp}}</td>
                  <td>{{ $proveedor->Sitioweb}}</td>
                  <td>{{ $proveedor->Facebook}}</td>
                  <td>{{ $proveedor->Instagram}}</td>
              @if($proveedor->estado_id == 1)
                  <td >
                   Activo
                  </td>
              @else
                  <td>
                 Inactivo 
                  </td>

              @endif
               
                  <td>{{ $proveedor->tenants_id}}</td>
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