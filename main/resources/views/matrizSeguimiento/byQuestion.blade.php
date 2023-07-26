@extends('layouts.base')

@section('titulo')
    Matriz de Seguimiento
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Editar Seguimientos</h1>
    </div>
@endsection

@section('cuerpo')
<div class="container">
    <form action="{{route('matriz.updateQuestion',['id'=>$seguimientos[0]->id])}}" method="post" >
        @csrf
        @method('PUT')
        @if($pregunta==4)
        <input type="hidden" value="4" name="pregunta">
        @endif
        @if($pregunta==5)
        <input type="hidden" value="5" name="pregunta">
        @endif
        <div class="row" id="pregunta_cuatro" @if($pregunta==5) style="display:none;" @endif>
            <div class="col">
                <label for="">Se le ha echo seguimiento Constante?</label>
                <div class="input-group-text">
                    <label for="">Si</label>
                    <input id="pregunta4" type="checkbox" aria-label="Checkbox for following text input" name="pregunta4" value="1" class="grupo4" @if ($seguimientos[0]->respuesta_cuatro == 1) checked @endif>
                    <label for="">No</label>
                    <input id="pregunta4Not" type="checkbox" aria-label="Checkbox for following text input" name="pregunta4" value="0" class="grupo4" @if ($seguimientos[0]->respuesta_cuatro == 0) checked @endif>
                </div>
                <div class="form-group" id="visit4" @if ($seguimientos[0]->respuesta_cuatro == 0) style="display: none;" @endif>
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

        <div class="row" id="pregunta_cinco" @if($pregunta==4) style="display:none;" @endif>
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
                    <button class="btn btn-primary" type="button" onclick="addDate('datesLabelVisit','date_visit','datesInputVisit','visit')">add</button>
                    <button class="btn btn-danger" type="button" onclick="deleteDate('datesLabelVisit','date_visit','datesInputVisit','visit')">del</button>
                    <hr>
                    <label id="datesLabelVisit">Fechas Seleccionadas: </label>
                    <hr>
                    
                    <input type="hidden" name="datesInputVisit" id="datesInputVisit">
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <label for="">Observaciones</label>
            <textarea name="observaciones" id="obs" cols="30" rows="10"></textarea>
        </div> --}}

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{route('alerta.index')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
       
</div>
@endsection

@section('js-extra')
<script>
    //control de los checkBox
    $(document).ready(function() {
        const pregunta_cuatro = document.getElementById('pregunta_cuatro');
        const pregunta_cinco = document.getElementById('pregunta_cinco');

            $('.grupo4, .grupo5').on('change', function() {
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
        });
</script>

    <script>
        const datesCall = [];
        const datesVisit = [];

        var fechas_cuatro='<?= $seguimientos[0]->fechas_cuatro;?>';
        let string_fechas_cuatro = fechas_cuatro.replace(/"/g, '');
        var fechas_cinco='<?= $seguimientos[0]->fechas_cinco;?>';
        let string_fechas_cinco = fechas_cinco.replace(/"/g, '');

        if(string_fechas_cuatro !== 'null' && string_fechas_cuatro !== ''){
            datesCall.push(string_fechas_cuatro);
            updateLabelDates('datesLabelCall','datesInputCall','call');
        }
        
        if(string_fechas_cinco !== 'null' && string_fechas_cinco !== ''){
            datesVisit.push(string_fechas_cinco);
            updateLabelDates('datesLabelVisit','datesInputVisit','visit');
        }

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