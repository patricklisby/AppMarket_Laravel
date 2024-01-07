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

        

        <h3 class="card-title" style="text-align:center;">Bitacoras Registradas</h3>

          </div>
        </div>
    
      <div style="text-align:center;">
        <table role="presentation" style="width:60%;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;margin: 0 auto!important;">
          <thead style="background-color: cornflowerblue;" >
            <tr style="color: #fff;border: 1px solid #eee" >
              <th style="width:260px;padding:0;vertical-align:top">Id</th>
              <th style="width:260px;padding:0;vertical-align:top">Correo</th>
              <th style="width:260px;padding:0;vertical-align:top">Fecha Ingreso</th>
              <th style="width:260px;padding:0;vertical-align:top">Fecha Cierre</th>
              <th style="width:260px;padding:0;vertical-align:top">Estado</th>
            </tr>
          </thead>
            <tbody>
               
            @foreach($datos as $item)
            <tr style="border: 1px solid #eee" >
                  
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
                     Activo
                    @else
                      Inactivo
                    @endif
                  </td>
               </tr>
             @endforeach
            
            </tbody>
        </table>
        </div>
        <br>
        <br>
        <br>
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