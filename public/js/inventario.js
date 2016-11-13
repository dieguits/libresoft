$(document).ready(function() {

	/**
	 * Función para método de dialogo.
	 *
	 * @date 25/11/2015.
	 * @author Diego.Pérez.
	 */
	$("#dlgSetInventario").dialog({
		autoOpen: false,
		height: 580,
		width: 400,
		title: 'Agregar Inventario',
		modal: true,
		open: function(){
			
			$("#codigoarticulo").val('');
			$("#codigoarticulo").focus();
			$("#nombreTipoarti").val('');
			$("#tipoarti").val('');
			$("#cantidadcosto").val('');
			$("#cantidad").val('');

			$("#entrada").val('');
			$("#costoentrada").val('');
			$("#salida").val('');
			$("#costosalida").val('');
			$("#idinventario").val('-1');
		},
		close: function() {
			$("#codigoarticulo").val('');
			$("#nombreTipoarti").val('');
			$("#tipoarti").val('');
			$("#cantidadcosto").val('');
			$("#cantidad").val('');
			$("#entrada").val('');
			$("#costoentrada").val('');
			$("#salida").val('');
			$("#costosalida").val('');
			//$("#idinventario").val('-1');

     		$("#validanombre").attr('style', '');
     		$("#msgerror").attr('style', '');
     		$("#msgerror").html('');
		}
	});

	/**
	 * Autocompletar, servicio para autocompletar.
	 *
	 * @date 17/04/2014.
	 * @author Diego.Pérez - Mayer.Leal.
	 */
	$("#codigoarticulo").autocomplete({
		source: function( request, response ) {
			
			$.post(
				"../inventario/inventario/buscar",
				{"term":request.term},
				function(data){
					response($.map(data, function(item) {
						return{label:item.nombre, value:item.codigo, tipo:item.tipo, valor:item.valor, cantidad:item.canti, idarti:item.id, idinve:item.idd, ventacanti:item.cantiventa, valorventauni:item.artvalorventa}
					}));
				},
				'json'
			);
		},
		select: function(event, ui) {
			//alert(ui.item.label);
			$("#nombreTipoarti").val(ui.item.label);
			$("#idarticulo").val(ui.item.idarti);
			$("#tipoarti").val(ui.item.tipo);
			$("#cantidadcosto").val('$'+ui.item.valor);
			$("#cantidad").val(ui.item.cantidad);
			$("#idinventario").val(ui.item.idinve);
			$("#costoentrada").val('$'+ui.item.valor);
			$("#salida").val(ui.item.ventacanti);
			$("#costosalida").val('$'+ui.item.valorventauni);
		},
		close: function() {
        	//$("#referencia1").val("");
        	$("#entrada").focus();
      	},
		minLength: 1
	});

	/**
	 * Función para guardar el nuevo ingreso de inventario.
	 *
	 * @date 20/02/2014.
	 * @author Diego.Pérez.
	 */
	$("#frmSetInventario").submit(function(e) {
		e.preventDefault();

		//$("#frmSetTipoArticulo :disabled").removeAttr('disabled');
		//alert($(this).serialize() + " -- ");
		if(validar()) {
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(res) {
					$( "#dlgSetInventario" ).dialog("close");
					//alert(res);

	                //if($("#idinventario").val() != -1) {
	                	//alert(res);
	                	//$("#tblArticulo tbody").prepend(res);
	                    //$("#tr"+$("#idinventario").val).html(res);
	                    
	                //}else {
	                    //window.location.reload();

	                if (res.indexOf('<tr') > -1) {
	                	//alert('por aca paso');
	                	$("#tblArticulo tbody").prepend(res);
	                } else {
	                	//alert($("#idinventario").val());
	                	$("#tr"+$("#idinventario").val()).html(res);
	                }
	                    
	                //}
	                
				}
			);	
		}
		      
		$("#idTipoArticulo").prop('disabled', true);
		$("#idinventario").val = -1;         
		//document.getElementById("idTipoArticulo").disabled = 'disabled';
	});

});

/**
 * Función para abrir 
 *
 * @date 26/11/2015.
 * @author Diego.Perez.
 */
function agregarinventario() {

	$("#dlgSetInventario").dialog('open');
	$("#codigoarticulo").focus();
}

/**
 * Función para validar formulario de creación de articulo.
 *
 * @date 20/01/2016.
 * @author Diego.Pérez.
 */
function validar() {
	var validado = true;
	//alert($("#validaref").val());
	if($("#codigoarticulo").val() == null || $("#codigoarticulo").val() == '') {
		$("#validaref").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validaref").attr('style', '');
	}

	if($("#nombreTipoarti").val() == null || $("#nombreTipoarti").val() == '') {
		$("#validanom").attr('style', 'display: inline; position: initial; color: red;');	
		validado = false;
	} else {
		$("#validanom").attr('style', '');	
	}

	if($("#entrada").val() == null || $("#entrada").val() == '') {
		$("#validaentra").attr('style', 'display: inline; position: initial; color: red;');	
		validado = false;
	} else {
		$("#validaentra").attr('style', '');	
	}

	if($("#costoentrada").val() == null || $("#costoentrada").val() == '-1') {
		$("#validacosto").attr('style', 'display: inline; position: initial; color: red;');	
		validado = false;
	} else {
		$("#validacosto").attr('style', '');	
	}

	if(!validado) {
		$("#msgerror").attr('style', 'display: block; color: red; text-align: center; padding-bottom: 10px;');
		$("#msgerror").html('Debe ingresar los valores requeridos.');
	}

	return validado;
}