$(document).ready(function() {

	/**
	 * Función para el dialogo de crear y editar usuario.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	$("#dlgSetUsuario").dialog({
		autoOpen: false,
		height: 400,
		width: 390,
		title: 'Crear Usuario',
		modal: true,
		close: function() {
			$("#idUsuario").val(-1);
			$("#nombres").val('');
			$("#apellidos").val('');
     		$("#cedula").val('');
     		$("#nombreusuario").val('');
     		$("#clave").val('');
     		$("#tipousuario").val(-1);

     		$("#validanombres").attr('style', '');
			$("#validaapellidos").attr('style', '');
			$("#validacedula").attr('style', '');
			$("#validausuario").attr('style', '');
			$("#validaclave").attr('style', '');
			$("#validarole").attr('style', '');
     		$("#validacodigo").attr('style', '');
     		$("#msgerror").attr('style', '');
     		$("#msgerror").html('');
		}
	});

	/**
	 * Función para guardar el tipo de usuario.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	$("#frmSetUsuario").submit(function(e) {
		e.preventDefault();
		var flag = validar();
		if(flag == true) {
		
			//$("#frmSetUsuario :disabled").removeAttr('disabled');
			//alert($(this).serialize());
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(res) {
					//alert(res);

	                if($("#idUsuario").val() != -1) {
	                	//alert('Actualizo');
	                    $("#tr"+$("#idUsuario").val()).html(res);
	                    $("#idUsuario").val(-1);
	                } else {
	                    //alert('Guardo');
	                    $("#tblArticulo tbody").prepend(res);
	                }
	                $("#dlgSetUsuario").dialog("close");
	                
				}
			);      
			//$("#idTipoUsuario").prop('disabled', true);
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
	/*$("#validanombres").attr('style', '');
	$("#validaapellidos").attr('style', '');
	$("#validacedula").attr('style', '');
	$("#validausuario").attr('style', '');
	$("#validaclave").attr('style', '');
	$("#validarole").attr('style', '');
	$("#validacodigo").attr('style', '');*/
	
	if($("#nombres").val() == null || $("#nombres").val() == '') {
		$("#validanombres").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validanombres").attr('style', '');
	}

	if($("#apellidos").val() == null || $("#apellidos").val() == '') {
		$("#validaapellidos").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validaapellidos").attr('style', '');
	}

	if($("#cedula").val() == null || $("#cedula").val() == '') {
		$("#validacedula").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validacedula").attr('style', '');
	}

	if($("#nombreusuario").val() == null || $("#nombreusuario").val() == '') {
		$("#validausuario").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validausuario").attr('style', '');
	}

	if(($("#clave").val() == null || $("#clave").val() == '') && $("#btnGuardarUsuario").html() != 'Actualizar') {
		$("#validaclave").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validaclave").attr('style', '');
	}

	if($("#role").val() == null || $("#role").val() == '-1') {
		$("#validarole").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validarole").attr('style', '');
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
function crearUsuario() {

	$("#dlgSetUsuario").dialog("open");

	$("#dlgSetUsuario").dialog('option', 'title', 'Guardar Usuario');
	$("#btnGuardarUsuario").html('Guardar');
}

/**
 * Función para actualizar usuario.
 *
 * @date 21/01/2016.
 * @author Diego.Pérez.
 */
function actualizarUsuario(idUsuario) {

	$("#dlgSetUsuario").dialog("open");	

	$("#dlgSetUsuario").dialog('option', 'title', 'Actualizar Usuario');
	$("#nombres").val($("#nombre"+idUsuario).val());
	$("#idUsuario").val($("#id"+idUsuario).val());
	$("#apellidos").val($("#apellidos"+idUsuario).val());
	$("#cedula").val($("#cedula"+idUsuario).val());
	$("#nombreusuario").val($("#usuario"+idUsuario).val());
	$("#clave").val('');
	$("#role").val($("#tipousuario"+idUsuario).val());
	
	$("#btnGuardarUsuario").html('Actualizar');
}

/**
 * Función para generar codigo de usuario.
 *
 * @date 21/01/2016.
 * @author Diego.Pérez.
 */
function generarUsuario() {

	$("#nombreusuario").val($("#nombres").val().substring(0, 3).toLowerCase() + $("#apellidos").val().substring(0, 3).toLowerCase());
}