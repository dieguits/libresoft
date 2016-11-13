$(document).ready(function() {
	
	var venta = new Array();

	$("#referencia1").focus();

	/**
	 * Método para ponerle acciones a determinada tecla oprimida.
	 *
	 * @date 21/12/2015.
	 * @author Diego.Pérez.
	 */
	$(document).keypress(function(e) {
		
		if(e.which == 13) {


			//var $focused = $(':focus');

			//var hasFocus = $("#referencia1").is(':focus');

			//alert(hasFocus);

			if($("#referencia1").is(':focus') && $("#referencia1").val() == '') {
				
				if(total != 0) {					
					$("#dlgpagar").dialog("open");	
					$("#totalventa").html($("#total").html());
				}

			}else if($("#cantidad"+idref).is(':focus')) {
				//alert($("#referencia1").val());
				if($("#cantidad"+idref).val() == null || $("#cantidad"+idref).val() == '') {
					$("#cantidad"+idref).val(1);
				}

				var calc = parseInt($("#cantidad"+idref).val()) * parseInt(valorini);
				$("#valor"+idref).html('$'+calc);
				$("#referencia1").focus();	

				subtotal += parseInt(calc);
				$("#sbtotal").html('$'+subtotal);

				total += parseInt(calc);
				
				$("#total").html(subtotal);
				//$("#frmAgregarProducto").preventDefault();
				$.post(
					$("#frmAgregarProducto").attr('action'),
					{ cantidad:$("#cantidad"+idref).val(), idproducto:$("#idd_"+idref).val(), iseliminarproducto:eliminarProducto },
					function(res) {
						//alert(res);
						if(parseInt(res) < parseInt($("#cantidad"+idref).val())) {
							alert('La cantidad de articulos requeridos no son suficientes, en inventario solo hay '+res+' articulos.');
							$("#cantidad"+idref).val('');
							$("#cantidad"+idref).focus();
						}
					}
				);
				
			}
			
		}else if(e.which == 16) {
			alert("has oprimido F10 !!!");
		}
	});
	
	/**
	 * Función para el dialogo de crear y editar articulo.
	 *
	 * @date 14/02/2014.
	 * @author Diego.Pérez.
	 */
	$("#dlgpagar").dialog({
		autoOpen: false,
		height: 250,
		width: 270,
		title: 'Realizar Venta',
		modal: true,
		close: function() {
			$("#validaref").attr('style', '');
     		$("#validanombre").attr('style', '');
     		$("#validaautor").attr('style', '');
     		$("#validatipo").attr('style', '');
     		$("#validavalor").attr('style', '');
     		$("#validavalorventa").attr('style', '');
     		$("#msgerror").attr('style', '');
     		$("#msgerror").html('');
		}
	});

	/**
	 * Función para realizar la venta final.
	 *
	 * @date 22/12/2015.
	 * @author Diego.Pérez.
	 */
	$("#frmSetVenta").submit(function(e) {
		e.preventDefault();
		//alert($("#tblArticulo").serialize());
		
		if(validar()) {
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(res) {
					//printDiv(res);
					//alert(res);
					$("#dlgpagar").dialog("close");
					setTimeout (function() { abrirDialogo() }, 7000);
					url = res + 'files/pdfs/test.pdf';
					
					window.frames['vamosimprimir'].focus();
					var iframe = document.getElementById('vamosimprimir');
					iframe.src = url;

					
	          		
	          		inicializarTablaArticulos();
				
				}
			);
		}else {
			alert('El valor ingresado no es suficiente para realizar el pago.');
		}
		              
	});

	/**
	 * Método para eliminar y agregar productos al carrito de compras.
	 *
	 * @date 27/01/2016.
	 * @author Diego.Pérez.
	 */
	$("#frmAgregarProducto").submit(function(e) {
		e.preventDefault();
		//alert(eliminarProducto);
		
	});

	/**
	 * Autocompletar, servicio para autocompletar.
	 *
	 * @date 17/04/2014.
	 * @author Diego.Pérez - Mayer.Leal.
	 */
	$("#referencia1").autocomplete({
		source: function( request, response ) {
			
			$.post(
				"../venta/venta/buscar",
				{"term":request.term},
				function(data){
					response($.map(data, function(item) {
						if(item.id == -1) {
							alert("Verifique que este articulo se encuentra registrado en inventario o contactese con el Administrador del sistema.");
							$("#referencia1").val('');
						}else {
							return{label:item.nombre, value:item.codigo, tipo:item.tipo, valor:item.valorventa, cantidad:item.canti, idarti:item.id, idinve:item.idd}
						}
					}));
				},
				'json'
			);
		},
		select: function(event, ui) {
			//alert(ui.item.idarti);
			if(ui.item.cantidad <= '0' || ui.item.idarti == -1) {
				alert('Este producto no se encuentra registrado en inventario.')
			} else {
			
				var res = '<tr id="idreferencia'+ui.item.idarti+'">';
				res +=	    '<td>';
				res +=          '<input type="hidden" id="idd_'+ui.item.idarti+'" name="idd_'+ui.item.idarti+'" value="'+ui.item.idarti+'">';
				res +=			'<input type="text" id="referencia'+ui.item.idarti+'" value="'+ui.item.value+'">';
				res +=		'</td>';
				res +=		'<td>';
				res +=			'<input type="text" id="cantidad'+ui.item.idarti+'" value="1">';
				res +=		'</td>';
				res +=		'<td>';
				res +=			'<label id="articulo">'+ui.item.label+'</label>';
				res +=		'</td>';
				res +=		'<td style="text-align: right;">';
				res +=			'<label id="valor'+ui.item.idarti+'">$'+ui.item.valor+'</label>';
				res +=		'</td>';
				res +=      '<td>';
				res += 	    	'<input id="elimiarProducto&&'+ui.item.idarti+'" type="button" onclick="eliminaProdu(this.id)" value="X" style="font-color: red;">';
				res +=      '</td>';
				res +=	'</tr>';

				$("#tblArticulo tbody").prepend(res);
				idref = ui.item.idarti;
				valorini = ui.item.valor;
				
			}
		},
		close: function() {
        	$("#referencia1").val("");
        	$("#cantidad"+idref).focus();
      	},
		minLength: 1
	});

});

////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////JAVASCRIPT/////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

var idref = 0;
var valorini = 0;
var subtotal = 0;
var total = 0;
var eliminarProducto = 0;

/**
 * Función para validar que se este realizando el pago correctamente.
 *
 * @date 26/01/2016.
 * @author Diego.Pérez.
 */
function validar() {
	
	flag = true;
	//alert($("#totalventa").html() + ' - ' + $("#pago").val())
	if(parseInt($("#totalventa").html()) > parseInt($("#pago").val())) {
		flag = false;
	}

	return flag;
}

/**
 * Función para hacer foco en el iframe y abrir dialogo de impresión para ticket de venta.
 *
 * @date 13/01/2016.
 * @author Diego.Perez.
 */
function abrirDialogo() {
	//window.frames['vamosimprimir'].focus();
	window.frames['vamosimprimir'].print();
}

/**
 * Función para hacer calculo de vueltos del pago a realizar.
 *
 * @date 21/12/2015
 * @author Diego.Perez.
 */
function calcularVueltos() {
	
	var totalvt = parseInt($("#total").html());
	var pagovt = parseInt($("#pago").val());
	var cambiovt = parseInt($("#cambio").html());
	
	//alert(pagovt);

	if(pagovt == "$0.0") {
		$("#cambio").html('$0.0');
	}else {
		$("#cambio").html(pagovt - totalvt);	
	}
	
	$("#prueba").val(total);
}

function vender() {
	if(total != 0) {					
		$("#dlgpagar").dialog("open");	
		$("#totalventa").html($("#total").html());
	}
}

/**
 * Función para inicializar la tabla de productos.
 *
 * @date 30/12/2015.
 * @author Diego.Pérez.
 */
function inicializarTablaArticulos() {

	//document.getElementById('tblArticulo').reload();

	idref = 0;
	valorini = 0;
	subtotal = 0;
	total = parseInt(0);
	//alert(total);

	$("#sbtotal").html('$000');
	$("#totalventa").html('000');
	$("#cambio").html('000');
	$("#pago").val('');
	$("#total").html('000');

	n = 1;
	$('#tblArticulo tr').each(function() {
		if($(this).attr('id') != 'idreferencia1' && typeof($(this).attr('id')) != 'undefined') {
			//alert($(this).attr('id'));
			$(this).remove();
		}
	    n++;
	});

	//$("#prueba").val(total);
	$("#referencia1").focus();
}

/**
 * Función para eliminar el articulo que no se desee vender.
 *
 * @date 26/01/2016.
 * @author Diego.Pérez.
 */
function eliminaProdu(boton) {
	//$("#elimiarProducto1").preventDefault();
	//alert('se va a eliminar el productos');
	idboton = boton.split("&&")[1];
	$.post(
		$("#frmAgregarProducto").attr('action'),
		{ idproducto:$("#idd_"+idboton).val(), iseliminarproducto:1 },
		function(res) {
			
			if(res == 1) {
				//alert('se elimino correctamente.');
				$('#tblArticulo tr').each(function() {
					if($(this).attr('id') != 'idreferencia1' && typeof($(this).attr('id')) != 'undefined' && $(this).attr('id') == 'idreferencia'+idboton+'') {
						//alert($("#valor"+idboton).html().replace('$',''));
						var resta = parseInt(total) - parseInt($("#valor"+idboton).html().replace('$',''));
						total = resta;
						$("#sbtotal").html('$'+total);
						$("#total").html(total);
						$(this).remove();
					}
				});	
			}
		}
	);
}

/**
 * Función para cancelar la venta y eliminar de session los elementos.
 *
 * @date 28/01/2016.
 * @author Diego.Perez.
 */
function vamoscancelar() {
	//alert('Vamos por buen camino');
	inicializarTablaArticulos();
	$.post(
		'../venta/venta/eliminarVenta',
		{iseliminarventa:1 },
		function(res) {
			alert(res);
		}
	);

	/*$('#tblArticulo tr').each(function() {
		if($(this).attr('id') != 'idreferencia1' && typeof($(this).attr('id')) != 'undefined') {
			//alert($("#valor"+idboton).html().replace('$',''));
			//var resta = parseInt(total) - parseInt($("#valor").html().replace('$',''));
			total = 0;
			$("#sbtotal").html('$'+total);
			$("#total").html(total);
			$(this).remove();
		}
	});*/
}

Number.prototype.format = function(n, x, s, c) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = this.toFixed(Math.max(0, ~~n));

    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};
