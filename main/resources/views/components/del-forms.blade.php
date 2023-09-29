@push('custom-css')
<style>
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        /* Fondo semi-transparente */
        display: flex;
        justify-content: center;
        /* Centrar horizontalmente */
        align-items: center;
        /* Centrar verticalmente */
        z-index: 9999;
        /* Z-index alto para que se superponga a otros elementos */
    }

    .loading-spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
        /* Animación de rotación */
    }

    /* Animación de rotación */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endpush

<div class="col-2 mb-2 text-center">
    {{-- <input type="checkbox" name="formularios[]" class="option-form" value="$col->id"> --}}
    <button type="button" id="del-forms" class="btn btn-sm btn-danger" style="display: none;">Eliminar
        Seleccionados</button>
</div>


<div class="loading-overlay" style="display: none;">
    <div class="loading-spinner"></div>
</div>

@push('custom-js')
<script>
    let id_forms = [];

function selectForms(event){
    let id = $(event).val();
    if ($(event).is(':checked')) {
        id_forms.push(id);

        if (id_forms.length > 0) {
            $('#del-forms').show();
        }
    } else {
        id_forms = id_forms.filter(function(item) {
            return item != id;
        });

        if (id_forms.length == 0) {
            $('#del-forms').hide();
        }
    }
};

$('#del-forms').click(function(event) {
    let deleteForms = confirm('¿Estas seguro de eliminar los formularios seleccionados?');

    if (deleteForms) {
        $.ajax({
            url: "{{ $route }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id_forms: id_forms
            },
            beforeSend: function() {
                $('.loading-overlay').show();
            },
            success: function(response) {
                if (response.status == 'success') {
                    alert(response.message);
                    $("#{{$table}}").DataTable().ajax.reload();
                } else {
                    alert(response.message);
                }
            },
            complete: function() {
                $('.loading-overlay').hide();
            },
            error: function(error) {
                console.log(error);
                alert('Ha ocurrido un error al eliminar los formularios seleccionados');
            }
        });
    }
});
</script>
@endpush