$(document).ready(function() {

	/**
	 * Función para el dialogo de crear y editar articulo.
	 *
	 * @date 14/02/2014.
	 * @author Diego.Pérez.
	 */
	$("#dlgSetArticulo").dialog({
		autoOpen: false,
		height: 440,
		width: 400,
		title: 'Crear Articulo',
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
	 * Función para manejar el método submit del formulario.
	 *
	 * @date 11/02/2014.
	 * @author Diego.Pérez.
	 */
	$("#frmSetArticulo").submit(function(e) {
		e.preventDefault();
		//alert($(this).serialize());
		var flag = validar();
		//alert(flag);
		if(flag == true) {
		
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(res) {
					//alert(res);
					$("#dlgSetArticulo").dialog("close");
	                if($("#idarticulo").val() != -1) {
	                    //alert('Actualizo');
	                    $("#tr"+$("#idarticulo").val()).html(res);
	                    $("#idarticulo").val(-1);
	                } else {
	                    //alert('Guardo');
	                    $("#tblArticulo tbody").prepend(res);
	                }
				}
			);
		}                
	});
	
});

/**
 * Función para validar formulario de creación de articulo.
 *
 * @date 24/11/2015.
 * @author Diego.Pérez.
 */
function validar() {
	var validado = true;
	//alert($("#validaref").val());
	if($("#codiarti").val() == null || $("#codiarti").val() == '') {
		$("#validaref").attr('style', 'display: inline; position: initial; color: red;');
		validado = false;
	} else {
		$("#validaref").attr('style', '');
	}

	if($("#nombrearticu").val() == null || $("#nombrearticu").val() == '') {
		$("#validanombre").attr('style', 'display: inline; position: initial; color: red;');	
		validado = false;
	} else {
		$("#validanombre").attr('style', '');	
	}

	if($("#autorarticu").val() == null || $("#autorarticu").val() == '') {
		$("#validaautor").attr('style', 'display: inline; position: initial; color: red;');	
		validado = false;
	} else {
		$("#validaautor").attr('style', '');	
	}

	if($("#selectarticu").val() == null || $("#selectarticu").val() == '-1') {
		$("#validatipo").attr('style', 'display: inline; position: initial; color: red;');	
		validado = false;
	} else {
		$("#validatipo").attr('style', '');	
	}

	if($("#valorarti").val() == null || $("#valorarti").val() == '') {
		$("#validavalor").attr('style', 'display: inline; position: initial; color: red;');	
		validado = false;
	} else {
		$("#validavalor").attr('style', '');	
	}

	if($("#valorartiventa").val() == null || $("#valorartiventa").val() == '') {
		$("#validavalorventa").attr('style', 'display: inline; position: initial; color: red;');	
		validado = false;
	} else {
		$("#validavalorventa").attr('style', '');
	}

	if(!validado) {
		$("#msgerror").attr('style', 'display: block; color: red; text-align: center; padding-bottom: 10px;');
		$("#msgerror").html('Debe ingresar los valores requeridos.');
	}

	return validado;
}

/**
 * Función para abrir dialogo de creación y vaciar campos.
 *
 * @date 24/11/2015.
 * @author Diego.Pérez.
 */
function crearArticulo() {

	$("#dlgSetArticulo").dialog( "open" );
	$("#dlgSetArticulo").dialog('option', 'title', 'Crear Articulo');

	$("#codiarti").val("");
	$("#idarticulo").val(-1);
	$("#nombrearticu").val("");
	$("#autorarticu").val("");
	$("#selectarticu").val(-1);
	$("#valorarti").val("");
	$("#valorartiventa").val("");
	$("#btnAccion").html('Guardar');
}

/**
 * Función para abrir dialogo de edición de producto y agregar valores a campos.
 *
 * @date 24/11/2015.
 * @author Diego.Pérez.
 */
function editarArticulo(idArticulo) {
	//alert($("#codigo"+idArticulo).val());

	$("#dlgSetArticulo").dialog( "open" );

	$("#dlgSetArticulo").dialog('option', 'title', 'Actualizar Articulo');

	$("#codiarti").val($("#codigo"+idArticulo).val());
	$("#idarticulo").val(idArticulo);
	$("#nombrearticu").val($("#nombre"+idArticulo).val());
	$("#autorarticu").val($("#autor"+idArticulo).val());
	$("#selectarticu").val($("#tipo"+idArticulo).val());
	$("#valorarti").val($("#valor"+idArticulo).val());
	$("#valorartiventa").val($("#valorventa"+idArticulo).val());

	$("#btnAccion").html('Actualizar');
}