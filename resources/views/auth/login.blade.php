<!doctype html>
<html lang="en">

    <head> 
        <meta charset="utf-8" />
        <title>Login | Admin </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/assets/img/favicon.ico') }}">
        <!-- Bootstrap Css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
         <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    </head>
    <body class="auth-body-bg">
    <div class="login-page text-center mt-5">
        <div class="container">
            <div class="bg-gradient"></div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                <a href ="{{ route('login') }}">
                                <img src="{{ asset('logo/logo.jpg') }}" width="250px" ></a>
                                <h4 class="text-muted text-center font-size-18"><b>Iniciar Sesión</b></h4>
                                <form class="form-vertical mt-3 row g-4" method="POST" action="{{ route('login') }}"> 
                                    @csrf     
                                    <div class="col-12">
                                            <div class="form-group">
                                                    <input class="form-control" id="email" name="email" type="text" required="" placeholder="Correo Electrónico">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                    <input class="form-control" id="password" name="password" type="password" required="" placeholder="Contraseña">
                                            </div>
                                            <div class="form-group mb-0 row mt-2">
                                                <div class="col-sm-6 mt-3">
                                                    <a href="{{ route('password.request') }}" class="float-end text-decoration-none text-primary text-muted">
                                                        Olvidó su Contraseña?</a>
                                                </div>
                                                <div class="col-sm-4 mt-3">
                                                <a href="{{ route('register') }}" class="float-end text-primary text-decoration-none text-muted">
                                                        Registrarse</a>
                                                </div>
                                            </div>
    
                                            <div class="form-group mb-3 text-center row mt-3 pt-1">
                                                <div class="col-12 float:rigth">
                                                    <button class="btn btn-info w-50 waves-effect waves-light" type="submit">Ingresar</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <img src="{{ asset('logo/LogIn.jpg') }}" width="100%" height="90%">
                            </div>
                        </div>
                    </div>
                    <p class="text-end text-secondary mt-3">Diseñado por Estudiantes de la UCR</p>
                </div>
            </div>
        </div>
    </div>
    </body>
        <!-- JAVASCRIPT -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ asset('backend/assets/js/app.js') }}"></script>

         <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif
</script>

    </body>
</html>