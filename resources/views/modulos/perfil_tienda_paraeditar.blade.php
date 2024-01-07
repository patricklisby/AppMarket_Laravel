<!-- Instanciamos un método para que muestre al usuario del TENANAT conectado
    y nos permita editar el perfil de la TIENDA, es decir; del TENANT -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="col-12 col-md-8">

    <div class="card card-primary card-outline">

        <div class="card-header">

            <h5 class="m-0 text-uppercase text-secondary">

                <strong>Actualizar datos de la Tienda</strong>

            </h5>

        </div>

        <div class="card-body">

            <h6 class="card-title"><Strong>¡Modifique los datos de su Tienda!</Strong></h6>

            <br>
            <br>

            <form method="POST" action="{{ route('changedata.tenant') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" id="editarId" name="id">

                <div class="form-group">
                    <label for="inputEmail" class="control-label">Nombre del tenant</label>
                    <div>
                        <input name="NombreTenant" class="form-control" type="text" value="{{ $tenant->NombreTenant }}" id="NombreTenant">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="control-label">Nombre de la tienda</label>
                    <div>
                        <input name="nombreTienda" class="form-control" type="text" value="{{ $tenant->nombreTienda }}" id="nombreTienda">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="control-label">Dirección</label>
                    <div>
                        <input name="Direccion" class="form-control" type="text" value="{{ $tenant->Direccion }}" id="Direccion">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="control-label">Correo electrónico</label>
                    <div>
                        <input name="CorreoTenant" class="form-control" type="text" value="{{ $tenant->CorreoTenant }}" id="example-text-input" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Telefono</label>
                    <div>
                        <input name="Telefono" class="form-control" type="text" value="{{ $tenant->Telefono }}" id="Telefono">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Whatsapp</label>
                    <div>
                        <input name="Whatsapp" class="form-control" type="text" value="{{ $tenant->Whatsapp }}" id="Whatsapp">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Fecha Vencimiento</label>
                    <div>
                        <input name="FechaVencimiento" class="form-control" type="text" value="{{ $tenant->FechaVencimiento }}" id="FechaVencimiento" readonly>
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Logotipo</label>
                    <div>
                        <input name="Logotipo" class="form-control" type="text" value="{{ $tenant->Logotipo}}" id="FechaVencimiento" readonly>
                    </div>
                </div>
                <div class="form-group">

                    <label for="inputEstado" class="control-label">Estado</label>

                    <div>

                        <select class="form-select input-lg" name="estado_id" id="estado_id" required>
                            <option value="">Selecionar Estado</option>
                            @foreach($estados as $data)
                            <option value="{{$data->id}}" @if ($data->id == $tenant->estado_id) {{ 'selected' }} @endif> {{$data->NombreEstado}} </option>
                            @endforeach
                        </select>

                    </div>

                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2">
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Actualizar Perfil">
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>






<!-- Script para capturar las imágenes(leerlas) y cargarlas en el objeto de imagenes -->
<script type="text/javascript">
    //Funcion para editar la foto de perfil
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                //Se mostrará la imagen el el img con el nombre showImage
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    //Funcion para editar el tenant
    function editarTenants(id) {
        $.ajax({
            type: 'GET',
            url: '/tenant/edit/' + id,
            dataType: 'json',
            success: function(data) {
                //console.log(data)
                $('#editarId').val(data.id);
                $('#NombreTenant').val(data.NombreTenant);
                $('#nombreTienda').val(data.nombreTienda);
                $('#Direccion').val(data.direccion);
                $('#CorreoTenant').val(data.CorreoTenant);
                $('#Telefono').val(data.Telefono);
                $('#Whatsapp').val(data.Whatsapp);
                $('#FechaVencimeinto').val(data.FechaVencimiento);
                $('#estado_id').val(data.estado_id);
                $('#editarFecha').val(data.updated_at);
            }
        })
    }
</script>