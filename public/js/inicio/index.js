console.log('esto es el inicio js');
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
            console.log("ERROR GENERAL DEL SISTEMA, POR FAVOR INTENTE MÁS TARDE");
        }
    });
}

function countDataLeads(desde, hasta){
    $.ajax({
        type:"POST",
        dataType:"json",
        url: baseurl+'Inicio/dataLeadsCount',
        data : {desde: desde, hasta:hasta},
        success:function(response){
            console.log(response);
            /* var meta=10 */
            if(response.matriculados['matriculados'] == "" || response.matriculados['matriculados'] == null){
                matri = 0
            }else{
                matri = response.matriculados['matriculados']
            }
            porcentaje = (matri / meta)*100
            if(meta < matri){
                $("#barraMatriculado").css({"width": "100%"});
                $("#porcentajeMatriculado").html('¡waooooo!, estamos por encima de la meta')
            }else if(meta == matri){
                $("#barraMatriculado").css({"width": "100%"});
                $("#porcentajeMatriculado").html('Completado')
            }else{
                $("#barraMatriculado").css({"width": Math.round(porcentaje)+"%"});
                porcentajeMatriculado.update(Math.round(porcentaje))
            }
            countUpMatriculados.update(matri)
            countUpPerdidos.update(response.perdidos['perdidos'])
            countUpNoContactados.update(response.noContactados['noContactados'])
            countUpLeadsEntrantes.update(response.leadsEntrantes['leadsEntrantes'])
        },error:function(){
            console.log("ERROR GENERAL DEL SISTEMA, POR FAVOR INTENTE MÁS TARDE");
        }
    });
}

setInterval(btn, 30000);
metaLeads()

function btn(){
    desde = moment($('#reportrange').data('daterangepicker').startDate._d).format("YYYY-MM-DD");
    hasta = moment($('#reportrange').data('daterangepicker').endDate._d).format("YYYY-MM-DD");
    countDataLeads(desde, hasta)
}