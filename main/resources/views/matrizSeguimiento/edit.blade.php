@extends('layouts.base')

@section('titulo')
    Matriz de Seguimiento
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Editar Matriz de Seguimiento</h1>
    </div>
@endsection

@section('cuerpo')
    <!-- Form -->
    <form action="{{route('matriz.update',['id'=>$seguimientos[0]->id])}}" method="post" >
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1">Celula</label>
                <input type="number" class="form-control" id="ID" name="ID" value="{{$seguimientos[0]->identificacion}}" placeholder="123456789" readonly>
                <input type="hidden" id="formulario_id" name="formulario_id" value="{{$seguimientos[0]->id}}">
              </div>
              <div class="col">
                  <label for="exampleFormControlInput1">Nombre</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$seguimientos[0]->usuario}}" placeholder="Su nombre" readonly>
              </div>
        </div>
        
        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1">Direccion</label>
                <input type="text" class="form-control" id="address" name="address" value="{{$seguimientos[0]->direccion}}" placeholder="Su direccion" readonly>
            </div>
            <div class="col">
                <label for="exampleFormControlInput1">Telefono</label>
                <input type="number" class="form-control" id="phone" name="phone" value="{{$seguimientos[0]->telefono}}" placeholder="5555555" readonly>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1">Referido</label>
                <input type="text" class="form-control" id="referred" name="referred" value="{{$seguimientos[0]->referido}}" placeholder="" readonly>
            </div>
        </div>

        <!-- Encuesta -->
        <div class="mt-5 mb-5 p-3 bg-light">
            <div class="row">
                <div class="col">
                    <label for="">Se le enseño a votar?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta1" value="1" class="grupo1" @if ($seguimientos[0]->respuesta_uno == 1) checked @endif>
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta1" value="0" class="grupo1" @if ($seguimientos[0]->respuesta_uno == 0) checked @endif>
                      </div>
                </div>
        
                <div class="col">
                    <label for="">Se le pego publicidad?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta2" value="1" class="grupo2" @if ($seguimientos[0]->respuesta_dos == 1) checked @endif>
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta2" value="0" class="grupo2" @if ($seguimientos[0]->respuesta_dos == 0) checked @endif>
                      </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col">
                    <label for="">El dia de las elecciones tiene trasporte?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta3" value="1" class="grupo3" @if ($seguimientos[0]->respuesta_tres == 1) checked @endif>
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta3" value="0" class="grupo3" @if ($seguimientos[0]->respuesta_tres == 0) checked @endif>
                      </div>
                </div>
        
                <div class="col">
                    <label for="">Se le ha echo seguimiento constante?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input id="pregunta4" type="checkbox" aria-label="Checkbox for following text input" name="pregunta4" value="1" class="grupo4" @if ($seguimientos[0]->respuesta_cuatro == 1) checked @endif>
                        <label for="">No</label>
                        <input id="pregunta4Not" type="checkbox" aria-label="Checkbox for following text input" name="pregunta4" value="0" class="grupo4" @if ($seguimientos[0]->respuesta_cuatro == 0) checked @endif>
                    </div>
                    <div class="form-group" id="visit4" @if ($seguimientos[0]->respuesta_cuatro == 0) style="display: none;" @endif>
                        <label for="">En que fecha se le ha llamado?</label>
                        <input type="date" name="date_visit4" id="date_call">
                        <hr>
                        <label id="datesLabelCall">Fechas Seleccionadas: </label>
                        <hr>
                        
                        <input type="hidden" name="datesInputCall" id="datesInputCall">
                        <div id="obsCall_content">
                            <label for="">Observaciones</label><br>
                            <textarea name="" id="obsCall" cols="70" rows="3" ></textarea>
                            <button class="btn btn-primary" type="button" onclick="addDate('datesLabelCall','date_call','datesInputCall','call','obsCall','obsInputCall','accordionCall')">add</button>
                            <button class="btn btn-danger" type="button" onclick="deleteDate('datesLabelCall','date_call','datesInputCall','call','obsCall','obsInputCall','accordionCall')">del</button>
                            <input type="hidden" name="obsInputCall" id="obsInputCall" >
                        </div>
                        <div class="accordion mt-2" id="accordionCall">
                            <!-- conetenido -->
                        </div><br>
                        
                    </div>
                </div>    
            </div>
    
            <div class="row">
                <div class="col">
                    <label for="">Se le ha visitado?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input id="pregunta5" type="checkbox" aria-label="Checkbox for following text input" name="pregunta5" value="1" class="grupo5" @if ($seguimientos[0]->respuesta_cinco == 1) checked @endif>
                        <label for="">No</label>
                        <input id="pregunta5Not" type="checkbox" aria-label="Checkbox for following text input" name="pregunta5" value="0" class="grupo5" @if ($seguimientos[0]->respuesta_cinco == 0) checked @endif>
                    </div>
                    <div class="form-group" id="visit5" @if ($seguimientos[0]->respuesta_cinco == 0) style="display: none;" @endif>
                        <label for="">En que fecha se le ha visitado?</label>
                        <input type="date" name="date_visit5" id="date_visit">
                        <hr>
                        <label id="datesLabelVisit">Fechas Seleccionadas: </label>
                        <hr>
                        
                        <input type="hidden" name="datesInputVisit" id="datesInputVisit">
                        <div id="obsvisit_content">
                            <label for="">Observaciones</label><br>
                            <textarea name="" id="obsVisit" cols="70" rows="3" ></textarea>
                            <button class="btn btn-primary" type="button" onclick="addDate('datesLabelVisit','date_visit','datesInputVisit','visit','obsVisit','obsInputVisit','accordionVisit')">add</button>
                            <button class="btn btn-danger" type="button" onclick="deleteDate('datesLabelVisit','date_visit','datesInputVisit','visit','obsVisit','obsInputVisit','accordionVisit')">del</button>
                            <input type="hidden" name="obsInputVisit" id="obsInputVisit" >
                        </div>
                        <div class="accordion mt-2" id="accordionVisit">
                            <!-- conetenido -->
                        </div><br>
                    </div>
                </div>
        
                <div class="col">
                    <label for="">El lugar de votacion es cerca a su casa?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta6" value="1" class="grupo6" @if ($seguimientos[0]->respuesta_seis == 1) checked @endif>
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta6" value="0" class="grupo6" @if ($seguimientos[0]->respuesta_seis == 0) checked @endif>
                      </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="">Ha participado en actividades de forma frecuente?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input id="pregunta7" type="checkbox" aria-label="Checkbox for following text input" name="pregunta7" value="1" class="grupo7" @if ($seguimientos[0]->respuesta_siete == 1) checked @endif>
                        <label for="">No</label>
                        <input id="pregunta7Not" type="checkbox" aria-label="Checkbox for following text input" name="pregunta7" value="0" class="grupo7" @if ($seguimientos[0]->respuesta_siete == 0) checked @endif>
                    </div>
                    
                    <div class="form-group" id="stake" @if ($seguimientos[0]->respuesta_siete == 0) style="display: none;" @endif>
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

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Actualizar</button>
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
      
    <!-- management of dates and observations dynamically -->
      <script>
        const obsCall = [];
        const obsVisit = [];
        const datesCall = [];
        const datesVisit = [];
        const datesStake = [];

        var fechas_cuatro='<?= $seguimientos[0]->fechas_cuatro;?>';
        let string_fechas_cuatro = fechas_cuatro.replace(/"/g, '');
        var arr_fechas_cuatro = string_fechas_cuatro.split(',');
        var fechas_cinco='<?= $seguimientos[0]->fechas_cinco;?>';
        let string_fechas_cinco = fechas_cinco.replace(/"/g, '');
        var arr_fechas_cinco = string_fechas_cinco.split(',');
        var fechas_siete='<?= $seguimientos[0]->fechas_siete;?>';
        let string_fechas_siete = fechas_siete.replace(/"/g, '');
        
        //observaciones
        var obs_cuatro='<?= $seguimientos[0]->obs_cuatro;?>';
        let string_obs_cuatro = obs_cuatro.replace(/"/g, '');
        var arr_obs_cuatro = string_obs_cuatro.split(',');
        var obs_cinco='<?= $seguimientos[0]->obs_cinco;?>';
        let string_obs_cinco = obs_cinco.replace(/"/g, '');
        var arr_obs_cinco = string_obs_cinco.split(',');

        if(string_fechas_cuatro !== 'null' && string_fechas_cuatro !== ''){
            for(let i=0; i<arr_fechas_cuatro.length;i++){
                datesCall.push(arr_fechas_cuatro[i].trim());
            }
            updateLabelDates('datesLabelCall','datesInputCall','call');
        }
        
        if(string_fechas_cinco !== 'null' && string_fechas_cinco !== ''){
            for(let i=0; i<arr_fechas_cinco.length;i++){
                datesVisit.push(arr_fechas_cinco[i].trim());
            }
            updateLabelDates('datesLabelVisit','datesInputVisit','visit');
        }

        if(string_fechas_siete !== 'null' && string_fechas_siete !== ''){
            datesStake.push(string_fechas_siete);
            updateLabelDates('datesLabelStake','datesInputStake','stake');
        }

        if(string_obs_cuatro !== 'null' && string_obs_cuatro !== ''){
            for(let i=0; i<arr_obs_cuatro.length;i++){
                obsCall.push(arr_obs_cuatro[i].trim());
            }
            updateLabelDates('datesLabelStake','datesInputStake','stake');
            updateInputObs('obsInputCall','call','accordionCall');
        }

        if(string_obs_cinco !== 'null' && string_obs_cinco !== ''){
            for(let i=0; i<arr_obs_cinco.length;i++){
                obsVisit.push(arr_obs_cinco[i].trim());
            }
            updateLabelDates('datesLabelStake','datesInputStake','stake');
            updateInputObs('obsInputVisit','visit','accordionVisit');
        }

        //agregar una fecha seleccionada en el array dates[]
        function addDate(label_date,input_date_in,input_date_out,array,input_obs_in,input_obs_out,accordion) {
            const inputDate = document.getElementById(input_date_in);
        const date = inputDate.value;
        const obsCall = document.getElementById('obsCall');
        const obsVisit = document.getElementById('obsVisit');

        if (date) {
            if(array=='call'){
                if (obsCall.value == '') {
                    obsCall.setCustomValidity('Los campos fecha y observaciones son obligatorios'); 
                    obsCall.reportValidity();
                }
                else{
                    const index = datesCall.push(date) - 1;
                    addObs(input_obs_in,input_obs_out,array,index,accordion);
                    inputDate.value = '';
                }
                
            }
            if(array=='visit'){
                if (obsVisit.value == '') {
                    obsVisit.setCustomValidity('Los campos fecha y observaciones son obligatorios'); 
                    obsVisit.reportValidity();
                }
                else{
                    const index = datesVisit.push(date) - 1;
                    addObs(input_obs_in,input_obs_out,array,index,accordion);
                    inputDate.value = '';
                }
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
        function deleteDate(label_date,input_date_in,input_date_out,array,input_obs_in,input_obs_out,accordion) {
            const inputDateDel = document.getElementById(input_date_in);
            const dateDel = inputDateDel.value;

            if(array=='call'){
                const index = datesCall.findIndex((date) => date == dateDel);
                console.log(dateDel);
                console.log(datesCall);
                if (index !== -1) {
                    console.log(1);
                    datesCall.splice(index, 1);
                    
                    updateLabelDates(label_date,input_date_out,array);
                    inputDateDel.value = '';
                    delObs(input_obs_out,array,index,accordion);
                }   
            }
            if(array=='visit'){
                const index = datesVisit.findIndex((date) => date == dateDel);

                if (index !== -1) {
                    datesVisit.splice(index, 1);
                    
                    updateLabelDates(label_date,input_date_out,array);
                    inputDateDel.value = '';
                    delObs(input_obs_out,array,index,accordion);
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


        //----------------------------------------------------------------------------
        function newObservation(title, text, index,accordion){
            const accordionDiv = document.getElementById(accordion);

            const content = document.createElement('div');
            content.id = index;

            const header = document.createElement('div');
            header.classList.add('accordion-item');

            const H2 = document.createElement('h2');
            H2.classList.add('accordion-heade');

            const btn = document.createElement('button');
            btn.classList.add('accordion-button')
            btn.textContent = title;
            
            btn.setAttribute('type', 'button');
            btn.setAttribute('data-bs-toggle', 'collapse');
            btn.setAttribute('data-bs-target', '#openObs_'+ index);
            btn.setAttribute('aria-expanded', 'true');
            btn.setAttribute('aria-controls', 'panelsStayOpen-collapseOne');

            const body = document.createElement('div');
            body.classList.add('accordion-collapse');
            body.classList.add('collapse');
            body.classList.add('show');
            body.id = 'openObs_' + index;

            const body_content = document.createElement('div');
            body_content.classList.add('accordion-body');
            body_content.textContent = text;

            H2.appendChild(btn);
            header.appendChild(H2);
            body.appendChild(body_content);

            content.appendChild(header);
            content.appendChild(body);

            accordionDiv.appendChild(content);
            
        }
        function addObs(input_obs_in,input_obs_out,array,index,accordion) {
            const input_obs = document.getElementById(input_obs_in);
            const obs = input_obs.value;
            if (obs) {
                if(array=='call'){
                    obsCall.push(obs);
                    input_obs.value = '';  
                    updateInputObs(input_obs_out,array,accordion);
                } 
                if(array=='visit'){
                    obsVisit.push(obs);
                    input_obs.value = '';  
                    updateInputObs(input_obs_out,array,accordion);
                } 
            }
        }
        function updateInputObs(input_obs_out,array,accordion){
            const inputObs = document.getElementById(input_obs_out);
            const accordionDiv = document.getElementById(accordion);
            if(array=='call'){
                inputObs.value = obsCall.join(", ");
                accordionDiv.innerHTML='';
                for(let i=0; i<obsCall.length;i++){
                    newObservation('Observacion', obsCall[i], i,accordion);
                }
            }
            if(array=='visit'){
                inputObs.value = obsVisit.join(", ");
                accordionDiv.innerHTML='';
                for(let i=0; i<obsVisit.length;i++){
                    newObservation('Observacion', obsVisit[i], i,accordion);
                }
            }
        }

        function delObs(input_obs_out,array,index,accordion) {
            if(array=='call'){
                console.log('entro a call borrar');
                if (index !== -1) {
                    obsCall.splice(index, 1);
                    updateInputObs(input_obs_out,array,accordion);
                }   
            }
            if(array=='visit'){
                if (index !== -1) {
                    obsVisit.splice(index, 1);
                    updateInputObs(input_obs_out,array,accordion);
                }   
            }
        
        }
      </script>
@endsection