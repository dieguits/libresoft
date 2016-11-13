$(document).ready(function () {

    //alert("esta sirviendo");

    $('#data_5 .input-daterange').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true
    });

    $("#frmImprimeInventario").submit(function (e) {
        e.preventDefault();

        $.post(
                $(this).attr('action'),
                {
                    fechaini: $("#fini").val(),
                    fechafin: $("#fin").val()
                },
                function (res) {

                    //alert(res);
                    window.open(res);


                }
        );
    });
    
    $("#consultar").click(function (e) {
       e.preventDefault();
       //alert("Vamos bien");
       tabla.draw();
    });
    
    var tabla = $('#dtreporte').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "autoWidth": false,
        //"paging": true,
        "ajax": {
            "url": "../reportes/inventario/buscarInventario",
            "type": "POST"
        },
        //"data": obj.servicios,
        "columns": [   
            {"data": "nombre", "name": "nombre"},
            {"data": "cantidad", "name": "cantidad"},
            {"data": "nombretip", "name": "nombretip"},
            {"data": "valor", "name": "valor"},
            {"data": "autor", "name": "autor"},
            {"data": "nombretip", "name": "nombretip"}

        ],
        "columnDefs": [
            {
                "targets": 1,
                "data": "nombre",
                "orderable": false
            },
            {
                "targets": 2,
                "orderable": false
            },
            {
                "targets": 3,
                "orderable": false
            },
            {
                "targets": 4,
                "orderable": false
            }/*,
            {
                "targets": -1,
                "data": "usuario",
                "render": function (data, type, full, meta) {
                    var html = '';
                    html += '<div class="btn-group btn-group-xs" role="group" aria-label="Acciones">';
                    //html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-url="' + base_url + 'params/estado/view/' + data + '" data-title="Detalles del Estado" data-btn="false"><span class="glyphicon glyphicon-eye-open"></span> Ver</a>';
                    html += '<a href="#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-url="base_url params/estado/edit/' + data + '" data-title="Editar Estado" data-btn="true" data-btn-title="Guardar"><span class="glyphicon glyphicon-pencil"></span> Editar</a>';
                    //html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-url="' + base_url + 'params/estado/delete/' + data + '" data-title="Borrar Estado" data-btn="true"><span class="glyphicon glyphicon-remove"></span> Borrar</a>';
                    html += '</div>';
                    return (type == 'display') ? html : data;
                },
                "orderable": false,
                "searcheable": false
            }//_'+data+'*/
        ],
        "language": {
            "url": "../../public/css/plugins/datatable-style/lang/Spanish.json"
        }
    });

});

/**
 *
 *
 * @author Diego.Pérez.
 * @date 18/02/2016.
 */
function consultarVentas() {
    //alert("Vamos a pintar " + $("#fini").val() + ' - ' + $("#fin").val());
    //inicializarTabla();
    tabla.draw();
    //alert($("#fini").val());
    /*$.post(
     '../reportes/venta/buscarVentasFecha',
     { fechaini:$("#fini").val(), fechafin:$("#fin").val() },
     function(res) {
     console.log(res);
     var rpthtml = '';
     
     $.map(res, function(item) {
     
     rpthtml = rpthtml + '<tr>'
     rpthtml = rpthtml + '<td>';
     rpthtml = rpthtml + item.nombrearticulo;
     rpthtml = rpthtml + '</td>';
     rpthtml = rpthtml + '<td>';
     rpthtml = rpthtml + item.cantidadventa;
     rpthtml = rpthtml + '</td>';
     rpthtml = rpthtml + '<td>';
     rpthtml = rpthtml + item.valoruni;
     rpthtml = rpthtml + '</td>';
     rpthtml = rpthtml + '<td>';
     rpthtml = rpthtml + item.valor;
     rpthtml = rpthtml + '</td>';
     rpthtml = rpthtml + '<td>';
     rpthtml = rpthtml + item.usuario;
     rpthtml = rpthtml + '</td>';
     rpthtml = rpthtml + '<td>';
     rpthtml = rpthtml + item.fecha;
     rpthtml = rpthtml + '</td>';
     rpthtml = rpthtml + '</tr>';
     });
     
     $("#rptventa tbody").prepend(rpthtml);
     },
     'json'
     );*/
}

function inicializarTabla() {
    n = 1;
    $('#rptventa tr').each(function () {
        //alert('Elimino '+$(this).attr('id'));
        if ($(this).attr('id') != 'columnas') {
            //alert('Elimino '+$(this).attr('id'));
            $(this).remove();
        }
        n++;
    });
}
