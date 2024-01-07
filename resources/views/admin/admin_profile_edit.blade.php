 <!-- Instanciamos un método para que muestre al usuario conectado
    y nos permita editar su perfil -->
    @php
   $id = Auth::user()->id;
    $editData = App\Models\User::find($id);
@endphp



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="col-12 col-md-8">
	
	<div class="card card-info card-outline">
		
		<div class="card-header card-info">
			
			<h5 class="m-0 text-uppercase text-secondary">
				
				<strong>Actualizar datos del Perfil</strong>

			</h5>

		</div>

		<div class="card-body">

        <form method="post" action="{{ route('changedata.profile') }}" enctype="multipart/form-data">
                @csrf

			<div class="form-group">

				<label for="inputName" class="control-label">Nombre Completo</label>

				<div>
					
                <input name="name" class="form-control" type="text" value="{{ $editData->name }}"  id="example-text-input">

				</div>

			</div>

			<div class="form-group">

				<label for="inputEmail" class="control-label">Correo electrónico</label>

				<div>
					
                <input name="email" class="form-control" type="text" value="{{ $editData->email }}"  id="example-text-input" readonly>

				</div>

			</div>

            <div class="form-group">

                <label for="labelFecha" class="control-label">Fecha Creación</label>

                <div>
                <input name="created_at" class="form-control" type="text" value="{{ $editData->created_at }}"  id="example-text-input" readonly>

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
    
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                //Se mostrará la imagen el el img con el nombre showImage
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

