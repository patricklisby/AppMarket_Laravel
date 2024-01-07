@extends('admin.admin_master')
@section('admin')


<div class="content-wrapper" style="min-height: 1058.31px;">
  <div class="card">
    <div class="card-body">
      <div class="container mb-5 mt-3">
        <div class="row d-flex align-items-baseline">
          <div class="col-xl-9">

          </div>
          <div class="col-xl-3 float-end ml-5">
            <a href="#" onclick="window.print();" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
            <a  href="{{ route('baucher.pdf') }}" class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Export</a>
          </div>
          <hr>
        </div>

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
                <li class="text-muted"><i class="fas fa-circle" style="color:#1A1A1A;"></i> <span class="fw-bold">Identificación de usuario: </span>{{$user->id}}</li>
                <li class="text-muted"><i class="fas fa-circle" style="color:#1A1A1A ;"></i> <span class="fw-bold">Fecha de creación: </span>{{date('Y/m/d')}}</li>

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

                </span><span style="font-size: 25px;">Total....$
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
            <div class="col-xl-2">
              <button type="button" class="btn btn-dark text-capitalize">Comprar</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection