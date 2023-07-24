@extends('layouts.base')

@section('titulo')
    Actividades
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Crear Actividades</h1>
    </div>
@endsection

@section('cuerpo')
<div class="container">
    <form action="{{route('actividad.store')}}"  enctype="multipart/form-data" id="form_actividad">
        @csrf
        <div class="alert alert-danger" id="alert" role="alert" style="display: none"></div>
        <div class="mb-3">
          <label for="inputCedula" class="form-label">Cedula</label>
          <input type="number" class="form-control" name="inputCedula" id="inputCedula" aria-describedby="Cedula" required>
          <input type="hidden" name="id_user" id="id_user" value="">
        </div>
        <div class="row">
            <div class="mb-3 col">
                <label for="inputNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="inputNombre" id="inputNombre" readonly>
            </div>
            @if(auth()->check())
            <div class="mb-3 col">
                <label for="inputDireccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="inputDireccion" id="inputDireccion" readonly>
            </div>
            @endif
        </div>
        @if(auth()->check())
        <div class="row">
            <div class="mb-3 col">
                <label for="inputTelefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="inputTelefono" id="inputTelefono" readonly>
            </div>
            <div class="mb-3 col">
                <label for="inputReferido" class="form-label">Referido</label>
                <input type="text" class="form-control" name="inputReferido" id="inputReferido" readonly>
            </div>
        </div>
        @endif
        <hr>
        <br>

        <div class="mb-3">
            <label for="inputFecha" class="form-label">Fecha de la actividad</label>
            <input type="date" class="form-control" name="inputFecha" id="inputFecha" required>
        </div>
        <div class="mb-3">
            <label for="inputTitulo" class="form-label">Nombre de la Actividad</label>
            <input type="text" class="form-control" name="inputTitulo" id="inputTitulo" required>
        </div>
        <div class="mb-3">
          <label for="inputDescript" class="form-label">Describa en que ayudo a participar</label>
          <textarea type="text" class="form-control" id="inputDescript" name="inputDescript" required></textarea>
        </div>
        <div class="mb-3">
            <label for="inputEvidencia" class="form-label">Evidencia</label>
            <input type="file" class="form-control" name="inputEvidencia" id="inputEvidencia" required>
        </div>

        <div class="d-flex justify-content-center">
          <img  src="" alt="" style="display: none; width: 35%;" id="preview_img" class="mt-2">
      </div>
        
        <br>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Crear</button>
            <a  href="{{ auth()->check() ? route('actividad.index') : route('home') }}" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
</div>
@endsection

@section('js-extra')
<script>
    //Request, obtain user data from the form according to CC
    $(document).ready(function() {
        
        $('#alert').hide();
        const input = document.getElementById('inputCedula');

        input.addEventListener('input', function() {

            var cedula = this.value.trim(); 
            
            $.ajax({
                url: '/actividades/getUsers', 
                type: 'GET', 
                dataType: 'json', 
                data: { cedula: cedula },
                success: function(response) {
                    if (response.status == 0) {
                        $('#alert').text(response.msg);
                        $('#alert').show();
                        document.getElementById('inputNombre').value = "";
                        document.getElementById('inputDireccion').value = "";
                        document.getElementById('inputTelefono').value = "";
                        document.getElementById('inputReferido').value = "";
                    } else {
                        $('#alert').hide();
                        document.getElementById('inputNombre').value = response[0].nombre;
                        document.getElementById('inputDireccion').value = response[0].direccion;
                        document.getElementById('inputTelefono').value = response[0].telefono;
                        document.getElementById('inputReferido').value = response[0].referido;
                    }
                    
                },
                error: function(xhr, status, error) {
                    console.error('Error en la petición:', error);
                }
            });

        });

        //Submission of the form
        $('#form_actividad').submit(function(event) {
      event.preventDefault(); // Prevent normal form submission

      var formData = new FormData(this);

      $.ajax({
        url: $(this).attr('action'),
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          if (data.error) {
            $('#alert').text(data.error);
            $('#alert').show();
          } else {
            $('#alert').removeClass('alert-danger').addClass('alert-success');
            $('#alert').text(data.success);
            $('#alert').show();

            setTimeout(function() {
              window.location.href = data.redirect;
            }, 3000);
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });
    });
  </script>

<!-- Preview of the uploaded image-->
  <script>
    $(document).ready(async function() {
        let evidencia = $('#inputEvidencia');
        let preview = $('#preview_img');

        evidencia.change(function(){
            let file = this.files[0];
            if (file == null) {
                    preview.hide();
                    preview.attr('src', '');
            }else{
                preview.show();
                preview.attr('src', URL.createObjectURL(file));
            }
        });
    });
  </script>
@endsection