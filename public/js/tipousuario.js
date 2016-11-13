$(document).ready(function() {

	/**
	 * Función para el dialogo de crear y editar articulo.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	$("#dlgSetTipoUsuario").dialog({
		autoOpen: false,
		height: 280,
		width: 370,
		title: 'Crear Tipo Usuario',
		modal: true,
		close: function() {
			$("#idTipoUsuario").val(-1);
			//$("#idtiparticulo").val(-1);
			$("#nombreTipoUsuario").val('');
			$("#codigoTipoUsuario").val('');
     		$("#validanombre").attr('style', '');
     		$("#validacodigo").attr('style', '');
     		$("#msgerror").attr('style', '');
     		$("#msgerror").html('');
		}
	});

	/**
	 * Función para guardar el tipo de articulo.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	$("#frmSetTipoUsuario").submit(function(e) {
		e.preventDefault();
		var flag = validar();
		if(flag == true) {
		
			$("#frmSetTipoUsuario :disabled").removeAttr('disabled');
			//alert($(this).serialize() + " vamos");
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(res) {
					//alert(res);

	                if($("#idTipoUsuario").val() != -1) {
	                	//alert('Actualizo');
	                    $("#tr"+$("#idTipoUsuario").val()).html(res);
	                    $("#idTipoUsuario").val(-1);
	                } else {
	                    //alert('Guardo');
	                    $("#tblArticulo tbody").prepend(res);
	                }
	                $("#dlgSetTipoUsuario").dialog("close");
	                
				}
			);      
			$("#idTipoUsuario").prop('disabled', true);
		}
		//document.getElementById("idTipoArticulo").disabled = 'disabled';
	});
});

/**
 * Función para validar el ingreso de información.
 *
 * @date 21/01/2016.
 * @author Diego.Pérez.
 */
function validar() {
	var validado = true;
	//alert($("#validaref").val());
	if($("#nombreTipoUsuario").val() == null || $("#nombreTipoUsuario").val() == '') {
		$("#validanombre").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validanombre").attr('style', '');
	}

	if($("#codigoTipoUsuario").val() == null || $("#codigoTipoUsuario").val() == '') {
		$("#validacodigo").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validacodigo").attr('style', '');
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
 * @date 21/01/2016.
 * @author Diego.Pérez.
 */
function crearTipoUsuario() {

	$("#dlgSetTipoUsuario").dialog("open");

	$("#dlgSetTipoUsuario").dialog('option', 'title', 'Guardar Tipo Usuario');
	$("#btnGuardarTipo").html('Guardar');
}

/**
 * Función para actualizar tipo articulo.
 *
 * @date 21/01/2016.
 * @author Diego.Pérez.
 */
function actualizarArticulo(idUsuario) {

	$("#dlgSetTipoUsuario").dialog("open");	

	$("#dlgSetTipoUsuario").dialog('option', 'title', 'Actualizar Tipo Articulo');
	$("#idTipoUsuario").val(idUsuario);
	//$("#idTipoUsuario").val(idArticulo);
	$("#nombreTipoUsuario").val($("#nombre"+idUsuario).val());
	$("#codigoTipoUsuario").val($("#codigo"+idUsuario).val());
	$("#btnGuardarTipo").html('Actualizar');
}

/**
 * Función para generar codigo de usuario.
 *
 * @date 21/01/2016.
 * @author Diego.Pérez.
 */
function generarCodigo(control) {

	$("#codigoTipoUsuario").val($("#nombreTipoUsuario").val().substring(0, 3));
}