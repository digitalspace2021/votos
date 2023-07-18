@extends('layouts.base')

@section('titulo')
    Matriz de Seguimiento
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Crear Matriz de Seguimiento</h1>
    </div>
@endsection

@section('cuerpo')
    <!-- Form -->
    <form action="{{route('matriz_create')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1">Celula</label>
                <input type="number" class="form-control" id="ID" name="ID" placeholder="123456789" required>
                <input type="hidden" id="formulario_id" name="formulario_id" value="">
              </div>
              <div class="col">
                  <label for="exampleFormControlInput1">Nombre</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Su nombre" readonly>
              </div>
        </div>
        
        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1">Direccion</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Su direccion" readonly>
            </div>
            <div class="col">
                <label for="exampleFormControlInput1">Telefono</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="5555555" readonly>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1">Referido</label>
                <input type="text" class="form-control" id="referred" name="referred" placeholder="" readonly>
            </div>
        </div>
        <div class="text-center mt-2">
            <a id="edit_form" href="#" class="btn btn-primary" style="display: none">Editar</a>
        </div>

        <!-- Encuesta -->
        <div class="mt-5 mb-5 p-3 bg-light">
            <div class="row">
                <div class="col">
                    <label for="">Se le enseño a votar?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta1" value="1" class="grupo1">
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta1" value="0" class="grupo1">
                      </div>
                </div>
        
                <div class="col">
                    <label for="">Se le pego publicidad?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta2" value="1" class="grupo2">
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta2" value="0" class="grupo2">
                      </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col">
                    <label for="">El dia de las elecciones tiene trasporte?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta3" value="1" class="grupo3">
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta3" value="0" class="grupo3">
                      </div>
                </div>
        
                <div class="col">
                    <label for="">Se le ha echo seguimiento constante?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input id="pregunta4" type="checkbox" aria-label="Checkbox for following text input" name="pregunta4" value="1" class="grupo4">
                        <label for="">No</label>
                        <input id="pregunta4Not" type="checkbox" aria-label="Checkbox for following text input" name="pregunta4" value="0" class="grupo4">
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
                </div>
                
            </div>
    
            <div class="row">
                <div class="col">
                    <label for="">Se le ha visitado?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input id="pregunta5" type="checkbox" aria-label="Checkbox for following text input" name="pregunta5" value="1" class="grupo5">
                        <label for="">No</label>
                        <input id="pregunta5Not" type="checkbox" aria-label="Checkbox for following text input" name="pregunta5" value="0" class="grupo5">
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

                </div>
                
        
                <div class="col">
                    <label for="">El lugar de votacion es cerca a su casa?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta6" value="1" class="grupo6">
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta6" value="0" class="grupo6">
                      </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="">Ha participado en actividades de forma frecuente?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input id="pregunta7" type="checkbox" aria-label="Checkbox for following text input" name="pregunta7" value="1" class="grupo7">
                        <label for="">No</label>
                        <input id="pregunta7Not" type="checkbox" aria-label="Checkbox for following text input" name="pregunta7" value="0" class="grupo7">
                    </div>
                    
                    <div class="form-group" id="stake" style="display: none;">
                        <label for="">En que fechas ha participado?</label>
                        <input type="date" name="date_stake" id="date_stake">
                        <button class="btn btn-primary" type="button" onclick="addDate('datesLabelStake','date_stake','datesInputStake','stake')">add</button>
                        <button class="btn btn-danger" type="button" onclick="deleteDate('datesLabelStake','date_stake','datesInputStake','stake')">del</button>
                        <hr>
                        <label id="datesLabelStake">Fechas Seleccionadas: </label>
                        <hr>
                        
                        <input type="hidden" name="datesInputStake" id="datesInputStake">
                    </div>

                </div>
            </div>
        </div>
        <!-- end Encuesta-->

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{route('matriz')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
    <!-- end form -->
@endsection

@section('js-extra')
    <script>
        //control de los checkBox
        $(document).ready(function() {
            $('.grupo1, .grupo2, .grupo3, .grupo4, .grupo5, .grupo6, .grupo7').on('change', function() {
                // Obtenemos el grupo al que pertenece el checkbox que cambió de estado
                var grupo = $(this).attr('class');

                // Deseleccionamos los otros checkboxes del mismo grupo
                $('.' + grupo).not(this).prop('checked', false);
            });

            //check pregunta 5
            const chek_pre5 = $('#pregunta5');
            const chek_pre5Not = $('#pregunta5Not');
            const div5 = document.getElementById('visit5');
            //YES
            chek_pre5.change(function() {
                if (this.checked) {
                    console.log('El checkbox está seleccionado556.');
                    div5.style.display = 'block';
                } else {
                    console.log('El checkbox está deseleccionado.');
                    div5.style.display = 'none';
                }
            });
            //NOT
            chek_pre5Not.change(function() {
                if (this.checked) {
                    console.log('NOT');
                    div5.style.display = 'none';
                } 
            });

            //check pregunta 4
            const chek_pre4 = $('#pregunta4');
            const chek_pre4Not = $('#pregunta4Not');
            const div4 = document.getElementById('visit4');
            //YES
            chek_pre4.change(function() {
                if (this.checked) {
                    console.log('El checkbox está seleccionado4.');
                    div4.style.display = 'block';
                } else {
                    console.log('El checkbox está deseleccionado.');
                    div4.style.display = 'none';
                }
            });
            //NOT
            chek_pre4Not.change(function() {
                if (this.checked) {
                    console.log('NOT');
                    div4.style.display = 'none';
                } 
            });

            //check pregunta 7
            const chek_pre7 = $('#pregunta7');
            const chek_pre7Not = $('#pregunta7Not');
            const div7 = document.getElementById('stake');
            //YES
            chek_pre7.change(function() {
                if (this.checked) {
                    console.log('YES');
                    div7.style.display = 'block';
                } 
                else{
                    div7.style.display = 'none';
                }
            });
            //NOT
            chek_pre7Not.change(function() {
                if (this.checked) {
                    console.log('NOT');
                    div7.style.display = 'none';
                } 
            });
  
        });

    </script>
      <script>
        //Peticion, obtener datos de usuarios del formulario segun CC
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
                        document.getElementById('formulario_id').value = response[0].id_form;
                        document.getElementById('name').value = response[0].nombre +' '+response[0].apellido;
                        document.getElementById('address').value = response[0].direccion;
                        document.getElementById('phone').value = response[0].telefono;
                        document.getElementById('referred').value = response[0].referido;

                        //mostrar btn editar
                        const editForm = document.getElementById('edit_form');
                        editForm.style.display = 'block';
                        //asignar href para editar info de formulario
                        var url = "/formularios/"+ response[0].id_form +"/actualizar";
                        $("#edit_form").attr("href", url);

                        
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
        const datesStake = [];

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
            if(array=='stake'){
                datesStake.push(date);
                console.log(datesStake);
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
            if(array=='stake'){
                labelDates.textContent = "Fechas Seleccionadas: " + datesStake.join(", ");
                inputDates.value = datesStake.join(", ");
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
            if(array=='stake'){
                const index = datesStake.indexOf(dateDel);

                if (index !== -1) {
                    datesStake.splice(index, 1);
                    
                    updateLabelDates(label_date,input_date_out,array);
                }
            }   
        }
      </script>
@endsection