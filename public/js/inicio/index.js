console.log('otro cambio');
var meta = null;
$(function() {
    moment.locale('es');
    var start = (parseInt(moment().format('D')) >= 16) ? moment().startOf('month').add(15, 'days') : moment().subtract(1, 'month').startOf('month').add(15, 'days');
    var end = (parseInt(moment().format('D')) >= 16) ? moment().endOf('month').add(15, 'days') : moment().subtract(1, 'month').endOf('month').add(15, 'days');
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Todos': [moment(new Date("2018-01-01")), moment()],
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
            'Esta Campaña': [
                (parseInt(moment().format('D')) >= 16) ? moment().startOf('month').add(15, 'days') : moment().subtract(1, 'month').startOf('month').add(15, 'days'),
                (parseInt(moment().format('D')) >= 16) ? moment().endOf('month').add(15, 'days') : moment().subtract(1, 'month').endOf('month').add(15, 'days')],
            'Este Mes': [moment().startOf('month'), moment().endOf('month')],
            'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Todo el Año': [moment().subtract(1, 'month').startOf('year'), moment().subtract(1, 'month').endOf('year')]
        }
    }, cb);
    cb(start, end);

});

const porcentajeMatriculado = new CountUp('porcentajeMatriculado', 0, 0, 0, 3, {
    prefix: ""
});

const countUpMatriculados = new CountUp('countMatriculados', 0, 0, 0, 3, {
    prefix: ""
});
const countUpPerdidos = new CountUp('countPerdidos', 0, 0, 0, 3, {
    prefix: ""
});
const countUpNoContactados = new CountUp('countNoContactados', 0, 0, 0, 3, {
    prefix: ""
});
const countUpLeadsEntrantes = new CountUp('countLeadsEntrantes', 0, 0, 0, 3, {
    prefix: ""
});
porcentajeMatriculado.start();
countUpMatriculados.start();
countUpPerdidos.start();
countUpNoContactados.start();
countUpLeadsEntrantes.start();

function metaLeads(){
    $.ajax({
        type:"POST",
        dataType:"json",
        url: baseurl+'Inicio/metaLeads',
        success:function(response){
            $("#metaLeads").html(response.meta)
            meta = response.meta
        },error:function(){
            mostrarMensaje('error','Error','ERROR GENERAL DEL SISTEMA, POR FAVOR INTENTE MÁS TARDE')
        }
    });
}

function countDataLeads(desde, hasta){
    metaLeads()
    $.ajax({
        type:"POST",
        dataType:"json",
        url: baseurl+'Inicio/dataLeadsCount',
        data : {desde: desde, hasta:hasta},
        success:function(response){
            /* console.log(response); */
            /* var meta=10 */
            if(response.matriculados['matriculados'] == "" || response.matriculados['matriculados'] == null){
                var matri = 0
            }else{
                var matri = response.matriculados['matriculados']
            }
            porcentaje = (matri / meta)*100
            var mensaje;
            
            switch (true) {
                case matri > 5:
                    mensaje = "El número es mayor que 5";
                    break;
                case matri < 5:
                    mensaje = "El número es menor que 5";
                    break;
                case matri === 5:
                    mensaje = "El número es igual a 5";
                    break;
                default:
                    mensaje = "El número no se puede comparar";
            }
            

            if(meta<matri){
                console.log('esto es el meta : ', meta);
                console.log('esto es el matri : ', matri);
                console.log('el matri es mayor');
                console.log('esto es el porcentaje: ', Math.round(porcentaje));
                console.log('===========================');
                $("#barraMatriculado").css({"width": "100%"});
                $("#porcentajeMatriculado").html('¡waooooo!, estamos por encima de la meta')
            }else if(meta==matri){
                console.log('esto es el meta : ', meta);
                console.log('esto es el matri : ', matri);
                console.log('el matri es igual al meta');
                console.log('esto es el porcentaje: ', Math.round(porcentaje));
                console.log('===========================');
                $("#barraMatriculado").css({"width": "100%"});
                $("#porcentajeMatriculado").html('Completado')
            }else{
                $("#barraMatriculado").css({"width": Math.round(porcentaje)+"%"});
                porcentajeMatriculado.update(Math.round(porcentaje))
                console.log('esto es el meta : ', meta);
                console.log('esto es el matri : ', matri);
                console.log('esto es el else xd');
                console.log('esto es el porcentaje: ', Math.round(porcentaje));
                console.log('===========================');
            }
            countUpMatriculados.update(matri)
            countUpPerdidos.update(response.perdidos['perdidos'])
            countUpNoContactados.update(response.noContactados['noContactados'])
            countUpLeadsEntrantes.update(response.leadsEntrantes['leadsEntrantes'])
        },error:function(){
            mostrarMensaje('error','Error','ERROR GENERAL DEL SISTEMA, POR FAVOR INTENTE MÁS TARDE')
        }
    });
}

function asesores_seguimiento(desde, hasta){
    $.ajax({
        type:"POST",
        dataType:"json",
        url: baseurl+'Inicio/dataAsesoresSeguimiento',
        data : {desde: desde, hasta:hasta},
        beforeSend: function() {
            $("#content_asesores div").remove()
        },
        success:function(response){
            /* console.log(response); */

            if(response){
                for (let i = 0; i < response.length; i++) {
                    if(response[i]['estado'] == 'CIERRE'){
                        estado = 'NUEVO CIERRE'
                        text_color = 'text-green-400'
                    }else if(response[i]['estado'] == 'NO CONTACTADO'){
                        estado = 'LEAD NO CONTACTADO' 
                        text_color = 'text-red-500'
                    }else if(response[i]['estado'] == 'PERDIDO'){
                        estado = 'LEAD PERDIDO'
                        text_color = 'text-red-500'
                    }
                    momento = mostrarTiempoRegistrado(response[i]['created_at'])
                    $("#content_asesores").append(`
                    <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                        <div
                            class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                            <svg class="h-6 w-6 ${text_color} group-hover:text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                            </svg>
                        </div>
                        <div class="w-full">
                            <a href="#" class="font-semibold ${text_color}">
                                `+estado+`
                                <span class="absolute inset-0"></span>
                            </a>
                            <div class="flex w-full justify-between">
                                <p class="mt-1 text-gray-600">Subido por `+response[i]['name']+' '+response[i]['last_name']+`</p>
                                <p class="text-gray-400">${momento}</p>
                            </div>
                        </div>
                    </div>`)
                }     
            }

        },error:function(){
            mostrarMensaje('error','Error','ERROR GENERAL DEL SISTEMA, POR FAVOR INTENTE MÁS TARDE')
        }
    });
} 


setInterval(btn, 10000);
metaLeads()

function btn(){
    desde = moment($('#reportrange').data('daterangepicker').startDate._d).format("YYYY-MM-DD");
    hasta = moment($('#reportrange').data('daterangepicker').endDate._d).format("YYYY-MM-DD");
    countDataLeads(desde, hasta)
    asesores_seguimiento(desde, hasta)
}




function mostrarTiempoRegistrado(fechaRegistro) {
    let ahora = moment(); // Obtener la fecha y hora actual
    let fecha = moment(fechaRegistro); // Convertir la fecha de registro a un objeto moment
    // Calcular la diferencia de tiempo entre la fecha de registro y ahora
    let minutosDiferencia = ahora.diff(fecha, 'minutes');
    let horasDiferencia = ahora.diff(fecha, 'hours');
    let diasDiferencia = ahora.diff(fecha, 'days');
    // Si el registro fue hace unos momentos, mostrar "Hace un momento"
    if (minutosDiferencia < 1) {
        return 'Hace un momento';
    }
    // Si el registro fue hace menos de una hora, mostrar "Hace X minutos"
    if (minutosDiferencia < 60) {
        return `Hace ${minutosDiferencia} minutos`;
    }
    // Si el registro fue hace menos de un día, mostrar "Hace X horas"
    if (horasDiferencia < 24) {
        return `Hace ${horasDiferencia} horas`;
    }
    // Si el registro fue ayer, mostrar "Ayer"
    if (diasDiferencia === 1 && ahora.date() !== fecha.date()) {
        return 'Ayer';
    }
    // Si el registro fue hoy, mostrar "Hoy"
    if (diasDiferencia === 0) {
        return 'Hoy';
    }
    // Si ninguna de las condiciones anteriores se cumple, mostrar la fecha en formato 'Y-M-D'
    return fecha.format('YYYY-MM-DD');
}

// Ejemplo de uso:
let fechaRegistro = '2024-03-15 11:56:47'; // La fecha de registro en formato 'Y-M-D H:M:S'
let tiempoRegistrado = mostrarTiempoRegistrado(fechaRegistro);
/* console.log('tiempo real :', tiempoRegistrado); 
 */