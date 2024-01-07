@extends('admin.admin_master')
@section('admin')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $numeroVentas }}</h3>

              <p><strong>Nuevas Ventas</strong></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $totalVentas }}</h3>

              <p><strong>Total Ventas</strong></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $numeroClientes }}</h3>

              <p><strong>Nuevos Clientes</strong></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $totalUsuarios }}</h3>

              <p><strong>Total Usuarios</strong></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="card card-info col-md-12 col-sm-12 col-lg-6 p-0">
        <div class="card-header">
          <h3 class="card-title">Ventas</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <div class="chart-size-monitor">
              <canvas id="chartContainer" class="chartjs-render-monitor" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block;"></canvas>
            </div>
          </div>
        </div>
      </div>



    </div>
  </section>
</div>

<!--  <script src="{{ asset('backend/assets/dist/js/app.js') }}"></script>-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
  fetch('/index/chart')
    .then(response => response.json())
    .then(data => {
      //console.log(data)
      var ctx = document.getElementById('chartContainer').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: data.labels,
          datasets: [{
            label: 'Cantidad',
            data: data.data,
            fill: false,
            showLine: true,
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: 5,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
          }]
        },

        options: {
          responsive: true,
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              gridLines: {
                display: false,
              }
            }],
            yAxes: [{
              gridLines: {
                display: false,
              }
            }]
          }
        }
      });
      console.log(data);
    });
</script>

@endsection