$(document).ready(function() {

	/**
	 * Función para el dialogo de crear y editar articulo.
	 *
	 * @date 14/02/2014.
	 * @author Diego.Pérez.
	 */
	$("#dlgSetTipoArticulo").dialog({
		autoOpen: false,
		height: 250,
		width: 378,
		title: 'Crear Tipo Articulo',
		modal: true,
		close: function() {
			$("#idTipoArticulo").val(-1);
			$("#idtiparticulo").val(-1);
			$("#nombreTipoarti").val('');
     		$("#validanombre").attr('style', '');
     		$("#msgerror").attr('style', '');
     		$("#msgerror").html('');
		}
	});

	/**
	 * Función para guardar el tipo de articulo.
	 *
	 * @date 11/02/2014.
	 * @author Diego.Pérez.
	 */
	$("#frmSetTipoArticulo").submit(function(e) {
		e.preventDefault();
		var flag = validar();
		if(flag == true) {
		
			$("#frmSetTipoArticulo :disabled").removeAttr('disabled');
			//alert($(this).serialize() + " vamos");
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(res) {
					//alert($("#idtiparticulo").val());

	                if($("#idtiparticulo").val() != -1) {
	                	//alert('Actualizo');
	                    $("#tr"+$("#idtiparticulo").val()).html(res);
	                    $("#idtiparticulo").val(-1);
	                } else {
	                    //alert('Guardo');
	                    $("#tblTipoArticulo tbody").prepend(res);
	                }
	                $("#dlgSetTipoArticulo").dialog("close");
	                
				}
			);      
			$("#idTipoArticulo").prop('disabled', true);
		}
		//document.getElementById("idTipoArticulo").disabled = 'disabled';
	});
});

/**
 * Función para validar el ingreso de información.
 *
 * @date 25/11/2015.
 * @author Diego.Pérez.
 */
function validar() {
	var validado = true;
	//alert($("#validaref").val());
	if($("#nombreTipoarti").val() == null || $("#nombreTipoarti").val() == '') {
		$("#validanombre").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validanombre").attr('style', '');
	}

	if(!validado) {
		$("#msgerror").attr('style', 'display: block; color: red; text-align: center; padding-bottom: 10px;');
		$("#msgerror").html('Debe ingresar los valores requeridos.');
	}

	return validado;
}

/**
 * Función para abrir dialogo de creación.
 *
 * @date 24/11/2015.
 * @author Diego.Pérez.
 */
function crearArticulo() {

	$("#dlgSetTipoArticulo").dialog("open");

	$("#dlgSetTipoArticulo").dialog('option', 'title', 'Guardar Tipo Articulo');
	$("#btnGuardarTipo").html('Guardar');
}

/**
 * Función para actualizar tipo articulo.
 *
 * @date 25/11/2015.
 * @author Diego.Pérez.
 */
function actualizarArticulo(idArticulo) {

	$("#dlgSetTipoArticulo").dialog("open");	

	$("#dlgSetTipoArticulo").dialog('option', 'title', 'Actualizar Tipo Articulo');
	$("#idTipoArticulo").val(idArticulo);
	$("#idtiparticulo").val(idArticulo);
	$("#nombreTipoarti").val($("#nombre"+idArticulo).val());
	$("#btnGuardarTipo").html('Actualizar');
}