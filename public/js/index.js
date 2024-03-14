console.log('esto es la consola general');
function cerrarAlertaMensaje(){
    $("#alert_mostrar_mensaje").attr('hidden', true)
}

function mostrarMensaje(estilo, titulo, mensaje) {
    $("#alert_mostrar_mensaje").attr('hidden', false)
    asignarEstiloModal(estilo);
    $("#mensaje-titulo").html(titulo);
    $("#mensaje-contenido").html(mensaje);
}

function asignarEstiloModal(estilo) {
    switch (estilo) {
        case "mensaje":
            $("#mensaje-header").css({"background-color": "#326299"});
            $("#mensaje-boton").css({"background-color": "#326299"});
            $("#mensaje-boton-aceptar").css({"display": "none"});
            $("#mensaje-boton").html("Aceptar");
            $("#mensaje-icono").removeClass().addClass("icon-info");
            break;
        case "exito":
            $("#mensaje-header").css({"background-color": "#6aa777"});
            $("#mensaje-boton").css({"background-color": "#6aa777"});
            $("#mensaje-boton-aceptar").css({"display": "none"});
            $("#mensaje-boton").html("Aceptar");
            $("#mensaje-icono").removeClass().addClass("icon-notification");
            break;
        case "error":
            $("#icon_alert").remove("#icon_alert svg").html(`<svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>`)
            $("#icon_alert").removeClass().addClass("mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10 bg-red-100");
            $("#mensaje-boton").removeClass().addClass("inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto")
            break;
        case "confirmacion":
            $("#icon_alert").remove("#icon_alert svg").html(`<svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="oc se axx">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
            </svg>`)
            $("#icon_alert").removeClass().addClass("mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10 bg-green-100");
            $("#mensaje-boton").removeClass().addClass("inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto")
            $("#mensaje-header").css({"background-color": "#d27131"});
            break;
        default :
            $("#mensaje-header").css({"background-color": "#326299"});
            $("#mensaje-boton").css({"background-color": "#326299"});
            $("#mensaje-boton-aceptar").css({"display": "none"});
            $("#mensaje-boton").html("Aceptar");
            $("#mensaje-icono").removeClass();
            break;
    }
}