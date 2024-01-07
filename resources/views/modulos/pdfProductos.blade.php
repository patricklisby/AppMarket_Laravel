<!doctype html>
<html lang="en">

<head>
    <title>Productos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
        table {
            text-align: center;
            border-collapse: collapse;
            height: auto;
           font-size: small;
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
    <div class="cont">
        <div class="nombreProducto">
            <h1>Productos</h1>
        </div>
        <div class="fecha">Fecha de consulta: {{$t}}</div>
    </div>


    <table id="table-responsive" class="table table-striped display responsive nowrap text-center" >
          <thead>
            @php($i = 1)
            @if(sizeOf($prodDatos) == 0)
            <div class="rounded-pill mt-2 mb-3 bg-blue p-1 w-100 text-center">
              <h3>No hay Datos Disponibles para este Usuario</h3>
            </div>
            @else
            <tr class="titulos">
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
              @if($item ->estado_id ==1)
                <td> Activo </td>
                @else
                <td> Inactivo </td>
                @endif
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
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