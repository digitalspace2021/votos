@extends('layouts.base')

@section('titulo')
    Matriz de Seguimiento
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
<h1>Matriz de seguimiento</h1>
@endsection

@section('cuerpo')
    <!-- Form -->
    <form action="{{route('matriz_create')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Celula</label>
          <input type="number" class="form-control" id="ID" name="ID" placeholder="123456789" >
          <input type="hidden" id="formulario_id" name="formulario_id" value="">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Su nombre" readonly>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Direccion</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Su direccion" readonly>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Telefono</label>
            <input type="number" class="form-control" id="phone" name="phone" placeholder="5555555" readonly>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Referido</label>
            <input type="text" class="form-control" id="referred" name="referred" placeholder="" readonly>
        </div>
        <div class="form-group">
            <label for="">Se le enseño a votar?</label>
            <div class="input-group-text">
                <label for="">Si</label>
                <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta1" value="1" class="grupo1">
                <label for="">No</label>
                <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta1" value="0" class="grupo1">
              </div>
        </div>

        <div class="form-group">
            <label for="">Se le pego publicidad?</label>
            <div class="input-group-text">
                <label for="">Si</label>
                <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta2" value="1" class="grupo2">
                <label for="">No</label>
                <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta2" value="0" class="grupo2">
              </div>
        </div>

        <div class="form-group">
            <label for="">Tiene carro o moto para ir a votar?</label>
            <div class="input-group-text">
                <label for="">Si</label>
                <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta3" value="1" class="grupo3">
                <label for="">No</label>
                <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta3" value="0" class="grupo3">
              </div>
        </div>

        <div class="form-group">
            <label for="">Se le ha echo seguimiento constante?</label>
            <div class="input-group-text">
                <label for="">Si</label>
                <input id="pregunta4" type="checkbox" aria-label="Checkbox for following text input" name="pregunta4" value="1" class="grupo4">
                <label for="">No</label>
                <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta4" value="0" class="grupo4">
              </div>
        </div>
        <div class="form-group" id="visit4" style="display: none;">
            <label for="">En que fecha se le ha llamado?</label>
            <input type="date" name="date_visit4" id="date_call">
            <button class="btn btn-primary" type="button" onclick="addDate('datesLabelCall','date_call','datesInputCall','call')">add</button>
            <button class="btn btn-danger" type="button" onclick="deleteDate('datesLabelCall','date_call','datesInputCall','call')">del</button>
            <hr>
            <label id="datesLabelCall">Fechas Seleccionadas: </label>
            <hr>
            
            <input type="hidden" name="datesInputCall" id="datesInputCall">
            
        </div>

        <div class="form-group">
            <label for="">Se le ha visitado?</label>
            <div class="input-group-text">
                <label for="">Si</label>
                <input id="pregunta5" type="checkbox" aria-label="Checkbox for following text input" name="pregunta5" value="1" class="grupo5">
                <label for="">No</label>
                <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta5" value="0" class="grupo5">
              </div>
        </div>
        <div class="form-group" id="visit5" style="display: none;">
            <label for="">En que fecha se le ha visitado?</label>
            <input type="date" name="date_visit5" id="date_visit">
            <button class="btn btn-primary" type="button" onclick="addDate('datesLabelVisit','date_visit','datesInputVisit','visit')">add</button>
            <button class="btn btn-danger" type="button" onclick="deleteDate('datesLabelVisit','date_visit','datesInputVisit','visit')">del</button>
            <hr>
            <label id="datesLabelVisit">Fechas Seleccionadas: </label>
            <hr>
            
            <input type="hidden" name="datesInputVisit" id="datesInputVisit">
        </div>

        <div class="form-group">
            <label for="">El lugar de votacion es cerca a su casa?</label>
            <div class="input-group-text">
                <label for="">Si</label>
                <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta6" value="1" class="grupo6">
                <label for="">No</label>
                <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta6" value="0" class="grupo6">
              </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
    <!-- end form -->
@endsection

@section('js-extra')
    <script>
        //control de los checkBox
        $(document).ready(function() {
            $('.grupo1, .grupo2, .grupo3, .grupo4, .grupo5, .grupo6').on('change', function() {
                // Obtenemos el grupo al que pertenece el checkbox que cambió de estado
                var grupo = $(this).attr('class');

                // Deseleccionamos los otros checkboxes del mismo grupo
                $('.' + grupo).not(this).prop('checked', false);
            });

            const chek_pre5 = $('#pregunta5');
            const div5 = document.getElementById('visit5');
            chek_pre5.change(function() {
            if (this.checked) {
                console.log('El checkbox está seleccionado556.');
                div5.style.display = 'block';
            } else {
                console.log('El checkbox está deseleccionado.');
                div5.style.display = 'none';
            }
            });

            const chek_pre4 = $('#pregunta4');
            const div4 = document.getElementById('visit4');
            chek_pre4.change(function() {
            if (this.checked) {
                console.log('El checkbox está seleccionado4.');
                div4.style.display = 'block';
            } else {
                console.log('El checkbox está deseleccionado.');
                div4.style.display = 'none';
            }
            });
            
            
        });

    </script>
      <script>
        //Peticion, obtener datos de usuarios del formulario
        $(document).ready(function() {

            const input = document.getElementById('ID');

            input.addEventListener('input', function() {
  
                var ID = this.value.trim(); 
                
                $.ajax({
                    url: '/matrizSeguimiento/userForm', 
                    type: 'GET', 
                    dataType: 'json', 
                    data: { id: ID },
                    success: function(response) {
                        //console.log('Respuesta del servidor:', response[0].nombre);
                        document.getElementById('formulario_id').value = response[0].id;
                        document.getElementById('name').value = response[0].nombre +' '+response[0].apellido;
                        document.getElementById('address').value = response[0].direccion;
                        document.getElementById('phone').value = response[0].telefono;
                        document.getElementById('referred').value = response[0].referido;

                        
                    },
                    error: function(xhr, status, error) {
                        
                        console.error('Error en la petición:', error);
                    }
                });

            });
        });
      </script>
      <script>
        
        const datesCall = [];
        const datesVisit = [];

        //agregar una fecha seleccionada en el array dates[]
        function addDate(label_date,input_date_in,input_date_out,array) {
        const date = document.getElementById(input_date_in).value;

        if (date) {
            if(array=='call'){
                datesCall.push(date);
                console.log(datesCall);
            }
            if(array=='visit'){
                datesVisit.push(date);
                console.log(datesVisit);
            }   
            updateLabelDates(label_date,input_date_out,array);
        }
        }
        //actualizar el label con los datos del array dates[]
        function updateLabelDates(label_date,input_date_out,array) {
            console.log(label_date.toString());
            const labelDates = document.getElementById(label_date);
            const inputDates = document.getElementById(input_date_out);
            if(array=='call'){
                labelDates.textContent = "Fechas Seleccionadas: " + datesCall.join(", ");
                inputDates.value = datesCall.join(", ");
            }
            if(array=='visit'){
                labelDates.textContent = "Fechas Seleccionadas: " + datesVisit.join(", ");
                inputDates.value = datesVisit.join(", ");
            }   
            
        }
        //eliminar una fecha del array dates[]
        function deleteDate(label_date,input_date_in,input_date_out,array) {
            const dateDel = document.getElementById(input_date_in).value;

            if(array=='call'){
                const index = datesCall.indexOf(dateDel);

                if (index !== -1) {
                    datesCall.splice(index, 1);
                    
                    updateLabelDates(label_date,input_date_out,array);
                }   
            }
            if(array=='visit'){
                const index = datesVisit.indexOf(dateDel);

                if (index !== -1) {
                    datesVisit.splice(index, 1);
                    
                    updateLabelDates(label_date,input_date_out,array);
                }
            }   
        }
      </script>
@endsection