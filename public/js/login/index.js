$(document).on('submit', "#form_login", function(event){
    event.preventDefault();
    var datos = $(this).serialize();
    $.ajax({
        type:"POST",
        dataType:"json",
        url:'Home/validarDatos',
        data:datos,
        success:function(response){
            if (response == "rs") {
                window.location.href = 'inicio';
            }else if(response == 'incorrecto'){
                mostrarMensaje('error','Datos invalidos','Sus credenciales son incorrectas')
            }else if(response == 'vacio'){
                mostrarMensaje('error','Usted no tiene Acceso','Por favor ingrese sus datos')
            }
        },error:function(){
          console.log("ERROR GENERAL DEL SISTEMA, POR FAVOR INTENTE MÁS TARDE");
        }
    });

});