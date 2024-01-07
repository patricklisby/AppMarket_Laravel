<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dashboard') }}" class="brand-link">
    <img src="{{ asset('backend/assets/dist/img/logo.gif') }}" alt="Logo appMarket" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">appMarket</span>
  </a>


  @php
  $id = Auth::user()->id;
  $adminData = App\Models\User::find($id);
  @endphp

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/sinFoto.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('admin.profile') }}" class="d-block">{{ $adminData->name }}</a>
        <span class="text-muted">
          <i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
          Online
        </span>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{ route('dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Escritorio
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
        </li>

        <!--=====================================
          Hacer un If para validar el usuario
        ======================================-->

        <!--=====================================
Botón Perfil Empresarial del Tenant
======================================-->
        @if($adminData->perfil == 'Admin')
        <li class="nav-item">
          <a href="{{ route('tenant.edit') }}" class="nav-link">
            <i class="nav-icon fas fa-store"></i>
            <p>
              Perfil de Tienda
            </p>
          </a>
        </li>
        @endif

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Módulos
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">6</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('modulos.categorias') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categorias</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('modulos.clientes') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Clientes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('modulos.proveedores')  }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Proveedores</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('modulos.productos')  }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Productos</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('modulos.ventas') }}" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Ventas
            </p>
          </a>
        </li>

        @if($adminData->perfil === 'Admin')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Administrativo
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('modulos.usuarios')  }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Gestión de Usuarios</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('modulos.bitacoras')  }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bitácoras de Acceso</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('modulos.boucher') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Váucher</p>
              </a>
            </li>
          </ul>
        </li>
         
        @endif

         <li class="nav-item">
          <a href="{{ route('admin.logout') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Cerrar Sesión
            </p>
          </a>
        </li>
        </ul>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>