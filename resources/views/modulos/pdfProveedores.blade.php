<!doctype html>
<html lang="en">

<head>
    <title>Proveedores</title>
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
    <div class="cont">
        <div class="nombre">
            <h1>Proveedores</h1>
        </div>
        <div class="fecha">Fecha de consulta: {{$t}}</div>
    </div>


    <table id="datatable" class="table table-bordered display responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class  = "titulos">
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
                            @foreach($estados as $estado)
                            @if ($item->estado_id == $estado->id)
                            <td>
                                {{$estado->NombreEstado}}</td>
                            @endif
                            @endforeach
                            <td> {{ $item->tenants_id }} </td>

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