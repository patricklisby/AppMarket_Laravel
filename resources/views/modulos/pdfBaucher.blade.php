<!doctype html>
<html lang="en">

<head>
    <title>Bitacoras</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
        table {
            text-align: center;
            border-collapse: collapse;
        }

        tr,
        td,
        th {
            border: 1px solid grey;
        }

        .titulos {
            background-color: lightgreen;
        }

        .Nombre {
            display: flex;
            justify-content: center;

        }

        .title {
            background-color: lightgreen;
        }

        h1 {
            text-align: center;
        }

        .generado {
            text-align: center;
            font-style: italic;
        }
    </style>
    <script>
        let fecha = document.getElementById("fecha");
        var now = new Date();
        fecha.innerHTML = "Fecha de consulta" + now;
    </script>

</head>

<body>
<div class="container">
        <div class="col-md-12">
          <div class="text-center">
            <h2 class="" style="color:#1A1A1A ;">AppMarket Vaucher</h2>
            <p class="pt-0">appmarket.com</p>
          </div>

        </div>


        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">To: <span style="color:#1A1A1A;">{{$cliente->NomCliente}}</span></li>
              <li class="text-muted">Correo electronico: <span style="color:#1A1A1A;">{{$cliente->CorreoCliente}}</span></li>
              <li class="text-muted"><i class="fas fa-phone"></i> {{$cliente->TelefonoCliente}}</li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Datos de facturación</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#1A1A1A;"></i> <span
                  class="fw-bold">Identificación de usuario: </span>{{$user->id}}</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#1A1A1A ;"></i> <span
                  class="fw-bold">Fecha de creación: </span>{{date('Y/m/d')}}</li>

            </ul>
          </div>
        </div>

        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead class="text-white table-dark">
              <tr>
                <th scope="col">Cantidad</th>
                <th scope="col">Nombre producto</th>
                <th scope="col">Precio unitario</th>
                <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($detallesxventas as $detalle)
                <tr>  
                  <td>{{$detalle->Cantidad}}</td>
                  <td>{{$detalle->descripcion}}</td>
                  <td>{{$detalle->precioVenta}}</td>
                  <td>{{$detalle->precioVenta*$detalle->Cantidad}}</td>
                  
                </tr> 
              @endforeach

            </tbody>

          </table>
        </div>
        <div class="row">
          <div class="col-xl-8">


          </div>
          <div class="col-xl-3">
            <ul class="list-unstyled">
              <li class="text-muted ms-3"><span class="text-black me-4">Subtotal de compra.... $</span>


                {{$ventas -> Subtotal}}
 

            </li>
              <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Impuestos({{$ventas->Impuesto}}%)....$
                @php
                  $impuestoImporte = $ventas->Subtotal * ($ventas->Impuesto/100)
                @endphp
                {{$impuestoImporte}}
              </span>
            </li>
            <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Descuento({{$ventas->Descuento}}%)....$
                @php
                  $descuento = $ventas->Subtotal * ($ventas->Descuento / 100);
                  
                @endphp
                {{$descuento}}
              </span>
            </li>
            </ul>
            <p class="text-black float-start"><span class="text-black me-3">

            </span><span
                style="font-size: 15px;">Total....$ 
                @php
                  $total = ($ventas->Subtotal + $impuestoImporte) - $descuento;
                @endphp
                {{$total}}
            </span></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-10">
            <p>Gracias por su compra</p>
          </div>
        </div>

      </div>
    <footer>
        <div class="data">
            <div class="generado">¡Este documento ha sido generado desde la aplicación APP MARKET!</div>
        </div>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>