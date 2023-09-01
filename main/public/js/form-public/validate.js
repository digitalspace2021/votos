jQuery.extend(jQuery.validator.messages, {
    required: "Este campo es obligatorio.",
    remote: "Por favor, rellena este campo.",
    email: "Por favor, escribe una dirección de correo válida",
    url: "Por favor, escribe una URL válida.",
    date: "Por favor, escribe una fecha válida.",
    dateISO: "Por favor, escribe una fecha (ISO) válida.",
    number: "Por favor, escribe un número entero válido.",
    digits: "Por favor, escribe sólo dígitos.",
    equalTo: "Por favor, escribe el mismo valor de nuevo.",
    accept: "Por favor, escribe un valor con una extensión aceptada.",
    maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
    minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
    rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
    range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
    max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
    min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
});

/* validate email with jquery vlidate using route */
$("#createProblem").validate({
    rules: {
        email: {
            email: true,
            remote: {
                /* meta name csrf-token */
                headers: {
                    "X-CSRF-TOKEN": _token,
                },
                url: routeValidateEmail,
                type: "post",
                data: {
                    email: function () {
                        return $('#email').val();
                    }
                }
            }
        },
        identificacion: {
            required: true,
            number: true,
            minlength: 7,
            maxlength: 15,
            remote: {
                /* meta name csrf-token */
                headers: {
                    "X-CSRF-TOKEN": _token,
                },
                url: routeValidateIdentificacion,
                type: "post",
                data: {
                    identificacion: function () {
                        return $('#identificacion').val();
                    }
                }
            }
        }
    },
    messages: {
        email: {
            email: "Por favor ingrese un email valido",
            remote: "El email ya se encuentra registrado"
        },
        identificacion: {
            required: "Por favor ingrese una identificacion",
            number: "Por favor ingrese solo numeros",
            minlength: "Por favor ingrese minimo 7 caracteres",
            maxlength: "Por favor ingrese maximo 15 caracteres",
            remote: "La identificacion ya se encuentra registrada"
        }
    },
    /* styles */
    errorElement: "div",
    errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");
        error.insertAfter(element);
    },
    /* spanish language for messages error */
});