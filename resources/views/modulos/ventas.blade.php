@extends('admin.admin_master')
@section('admin')

    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <div class="content-wrapper" style="min-height: 1058.31px;">

        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Módulo Ventas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="inicio" style="color: blue;"><i
                                        class="nav-icon fas fa-home"></i>&nbsp;Inicio</a></li>
                            <li class="breadcrumb-item active">Ventas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->

        </section>

        <!-- Main content -->
        <section class="content d-flex flex-direction-column ">

            <!-- Default box -->
            <div class="card w-100 mr-2">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="card-body">

                    <div class="d-flex">
                        <div class="input-group flex-grow-1 mr-2 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" value="{{ auth()->user()->tenant->NombreTenant }}"
                                readonly>
                        </div>
                        <div class="input-group flex-grow-1 mr-2 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" value="{{ auth()->user()->tenant->user->name }}"
                                readonly>
                        </div>
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                        </div>
                        <select class="form-control" id="cliente" name="cliente">
                            <option value="">Seleccionar cliente</option>
                            @foreach ($clientes as $cliente)
                                <option id="clientes" value="{{ $cliente->id }}">{{ $cliente->NomCliente }}</option>
                            @endforeach
                        </select>


                    </div>
                    <div class="container" id="carrito">

                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-comments"></i></span>
                        </div>
                        <input type="text" class="form-control mr-2" placeholder="Tipo Venta" id="tipoVenta">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-comments"></i></span>
                        </div>
                        <input type="text" class="form-control mr-2" placeholder="Descripcion" id="descripcionVenta">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"> Subtotal</i></span>
                        </div>
                        <input type="number" class="form-control mr-2" id="subtotal" readonly>



                    </div>

                    <div>
                        <div class="input-group mb-5">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-percent"></i></span>
                            </div>
                            <input type="number" class="form-control mr-2" placeholder="Impuesto" id="imp" min="0">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-percent"></i></span>
                            </div>
                            <input type="number" id="descuento" class="form-control mr-2" placeholder="Descuento" min="0">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"> Total</i></span>
                            </div>
                            <input type="text" class="form-control mr-2" id="Tot" readonly>
                        </div>
                    </div>

                    <div class="text-right">
                        <button id="generar" onclick="capturarValores()"
                            class="btn btn-success btn-md mb-3">Generar</button>
                    </div>

                </div>




                <!-- /.card-body -->

                <div class="card-footer">
                    <!--Footer-->
                </div>
                <!-- /.card-footer-->

            </div>
            <!-- /.card -->

            <!-- Default box -->
            <div class="card w-100 ml-2">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $ruta = 'images/';
                                @endphp
                                @php($i = 1)
                                @foreach ($producto as $datos)
                                    <tr>
                                        <td><img src="{{ asset($ruta . $datos->imagenProducto) }}" width="50px"
                                                height="50"></td>
                                        <td>{{ $datos->codigoBarras }}</td>
                                        <td>{{ $datos->descripcion }}</td>
                                        <td>${{ $datos->precioVenta }}</td>

                                        <td>
                                            <button @if ($datos->stock <= 5) class="btn btn-danger @endif
                                                @if ($datos->stock <= 10) class="btn btn-warning @endif
                                                @if ($datos->stock > 10) class="btn btn-success @endif
                                                type="button id="stock-btn-{{ $datos->id }}">{{ $datos->stock }}</button>
                                        </td>

                                        <td>
                                            <button @if ($datos->stock == 0) disabled @endif type="button"
                                                id="{{ $datos->codigoBarras }}" class="btn btn-dark agregar-producto"
                                                onclick="pasar('{{ $datos }}','{{ $datos->codigoBarras }}','{{ $datos->precioVenta }}')">Agregar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

    <div class="container" id="carrito">

    </div>

    <script>
        function bloque() {

            // Obtén el elemento del div principal
            var divPrincipal = document.getElementById('carrito');

            // Busca elementos div hijos dentro del div principal
            var divsHijos = divPrincipal.getElementsByTagName('div');

            // Verifica si se encontraron divs hijos
            if (divsHijos.length > 0) {
                document.getElementById("generar").disabled = false;
            } else {
                document.getElementById("generar").disabled = true;
                document.getElementById("Tot").value = null;
                document.getElementById("subtotal").value = null;
                document.getElementById("descuento").value = null;
                document.getElementById("imp").value = null;
            }
            refresco();
        }


        setInterval('bloque()', 0);

        function pasar(datos, codigoBarras, precioVenta) {

            document.getElementById(codigoBarras).disabled = true;
            idDiv = codigoBarras + 1;

            datos = JSON.parse(datos);

            var productoAgregado = $('<div class="input-group mb-3 producto-agregado" id="' + idDiv + '" >' +
                '<div class="input-group-prepend">' +
                '<button class="btn btn-danger" type="button" onclick="eliminar(\'' + idDiv + '\', \'' + codigoBarras +
                '\')">' +
                '<i class="fas fa-trash-alt"></i>' +
                '</button>' +
                '</div>' +
                '<input type="hidden" class="form-control id-producto " style="background-color: #fff; cursor: not-allowed;" placeholder="Nombre del producto" value="' +
                datos.id + '" readonly>' +
                '<input type="text" class="form-control descripcion-producto"  style="background-color: #fff; cursor: not-allowed;" placeholder="Nombre del producto" value="' +
                datos.descripcion + '" readonly>' +
                '<input type="number"" class="form-control cantidad" id="cantidad" placeholder="Cantidad" value=1 min="1" max="' +
                datos.stock + '" onkeydown="if(event.keyCode !== 38 && event.keyCode !== 40) return false;">' +
                '<div class="input-group-append">' +
                '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>' +
                '<input type="text" class="form-control precio" id="precio"  style="background-color: #fff; cursor: not-allowed; width: 90px;" placeholder="Precio" value="' +
                precioVenta + '" readonly>' +
                '</div>' +
                '</div>');
            $('#carrito').append(productoAgregado);

        }


        function eliminar(idDiv, codigoBarras) {
            document.getElementById(codigoBarras).disabled = false;
            document.getElementById(idDiv).remove();
        }


        function capturarValores() {
            let elementos = $('.producto-agregado');
            let productos = [];
            if (document.getElementById('cliente').value != "" && document.getElementById('tipoVenta').value != "" && 
                document.getElementById('descripcionVenta').value != "" && document.getElementById('imp').value != "" &&
                document.getElementById('descuento').value != "") {

            elementos.each(function() {
                let idProducto = $(this).find('.id-producto').val();
                let descuento = document.getElementById('descuento').value;
                let total = document.getElementById('Tot').value;
                let impuesto = document.getElementById('imp').value;
                let tipoVenta = document.getElementById('tipoVenta').value;
                let descripcionVenta = document.getElementById('descripcionVenta').value;
                let subtotal = document.getElementById('subtotal').value;
                let descripcion = $(this).find('.descripcion-producto').val();
                let cantidad = $(this).find('.cantidad').val();
                let precio = $(this).find('.precio').val();
                let usuario = $(this).find('#cliente').val();

                const producto = {
                    idProducto: parseInt(idProducto),
                    descuento: parseInt(descuento),
                    total: parseFloat(total),
                    impuesto: parseInt(impuesto),
                    tipoVenta: tipoVenta,
                    descripcionVenta: descripcionVenta,
                    subtotal: parseInt(subtotal),
                    descripcionProducto: descripcion,
                    cantidad: parseInt(cantidad),
                    precio: parseInt(precio),
                    cliente: parseInt(document.getElementById('cliente').value),
                };

                productos.push(producto);
            });

       

            const datos = {
                productos: productos
            };
            console.table(productos);
            // URL de tu ruta en Laravel donde deseas enviar los datos
            const url = "/guardar/ventas";

            // Configuración de la petición
            const opciones = {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify(datos)
            };

            // Enviar la petición a Laravel
            fetch(url, opciones)
                .then(response => response.json())
                .then(data => {
                    // Aquí puedes manejar la respuesta de Laravel
                    console.log("Datos provenientes del servidor: " + JSON.stringify(data));
                    window.location.replace("/modulo/baucher");
                    // Actualizar el stock en tiempo real
                    if (data.message) {
                        for (let i = 0; i < productos.length; i++) {
                            let producto = productos[i];
                            let stockBtn = $('#stock-btn-' + producto.idProducto);
                            let stock = parseInt(stockBtn.text());
                            let cantidad = parseInt(producto.cantidad);
                            let nuevoStock = stock - cantidad;

                            if (!isNaN(stock) && !isNaN(cantidad) && cantidad > 0 && nuevoStock >= 0) {
                                stockBtn.text(nuevoStock);
                            }
                        }
                    } else {
                        console.error("Error al guardar las ventas");
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }else{
            Swal.fire({
      text: "Existen campos vacios!",
      icon: "error",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 2000,
    });
        }
    }

        function refresco() {
            var elementos = $('.producto-agregado');
            let productos = [];

            elementos.each(function() {
                let nombreProducto = $(this).find('.nombre-producto').val();
                let cantidad = $(this).find('.cantidad').val();
                let precio = $(this).find('.precio').val();
                let cliente = document.getElementById('cliente').value;


                const venta = {
                    nombreProducto: nombreProducto,
                    cantidad: cantidad,
                    precio: precio,
                    cliente: cliente
                };

                productos.push(venta);
                calculable(productos);
            });
        }

        function calculable(productos) {
            let impuesto = 0;
            impuesto = parseInt(document.getElementById('imp').value);

            let descuento = 0;
            let valorDescuento = parseInt(document.getElementById("descuento").value);

            let subtotal = 0;

            let suma = 0;

            productos.forEach(function(producto) {


                let precio = parseInt(producto.precio);
                let cantidad = parseInt(producto.cantidad);



                if (!isNaN(precio) && !isNaN(cantidad)) {
                    suma += precio * cantidad;
                    subtotal += precio * cantidad;
                }
            });


            if (impuesto != "" && impuesto != 0 && !isNaN(impuesto)) {
                suma = suma * (1 + impuesto / 100);
            } else {
                suma = suma * (1 + 0 / 100);
            }

            if (!isNaN(valorDescuento)) {
                descuento = valorDescuento / 100;
                descuento *= suma;
                suma -= descuento;
            }
            document.getElementById("subtotal").value = subtotal;
            if (!isNaN(suma)) {
                document.getElementById("Tot").value = suma;
            }


        }
    </script>
@endsection
