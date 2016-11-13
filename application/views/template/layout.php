<!DOCTYPE html>
<html>
<head>
	<title>LibreSoft</title>
	<meta charset="utf-8" />
	
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-ui.min.js"></script>
    <link href="<?php echo base_url();?>public/css/jquery-ui.min.css" rel="stylesheet">
    
    
    <link href="<?php echo base_url();?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Data Tables -->
    <link href="<?php echo base_url(); ?>public/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>public/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>public/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

	
	
	<?php date_default_timezone_set("America/Bogota"); ?>
	<!--style type="text/css">
		body{
		    background:#fff;
		}

		nav{
		    /*Bordes redondeados*/
		    -webkit-border-radius:10px;/*Para chrome y Safari*/
		    -moz-border-radius:10px;/*Para Firefox*/
		    -o-border-radius:10px;/*Para Opera*/
		    border-radius:10px;/*El estandar por defecto*/
		    background-image: -webkit-gradient(linear, left top, left bottom, from(#FFF), to(#CCC));/*Para chrome y Safari*/
		    /*Degradados*/
		    background-image: -moz-linear-gradient(top center, #FFF, #CCC);/*Para Firefox*/
		    background-image: -o-linear-gradient(top, #FFF, #CCC);/*Para Opera*/
		    background-image: linear-gradient(top, #FFF, #CCC);/*El estandar por defecto*/
		    overflow:hidden;
		    padding:10px;
		    width:950px;
		}

		nav ul{
		    list-style:none;
		    margin:0px;
		    padding:0;
		}

		nav ul li{
		    /*Bordes redondeados*/
		    -webkit-border-radius:5px;/*Chrome y Safari*/
		    -moz-border-radius:5px;/*Firefox*/
		    -o-border-radius:5px;/*Opera*/
		    border-radius:5px;/*Estandar por defecto*/
		    float:left;
		    font-family:Arial, Helvetica, sans-serif;
		    font-size:16px;
		    font-weight:bold;
		    margin-right:10px;
		    text-align:center;
		    /*Sombras para texto, los mismos parametros que box-shadow*/
		    text-shadow: 0px 1px 0px #FFF;
		}

		nav ul li:hover{
		    /*Degradado de fondo*/
		    background-image: -webkit-gradient(linear, left top, left bottom, from(#FFF), to( #E3E3E3));/*Chrome y Safari*/
		    background-image: -moz-linear-gradient(top center, #FFF, #E3E3E3);/*Firefox*/
		    background-image: -o-linear-gradient(top, #FFF, #E3E3E3);/*Opera*/
		    background-image: linear-gradient(top, #FFF, #E3E3E3);/*Estandar por defecto*/
		    /*Sombras*/
		    -webkit-box-shadow:  1px -1px 0px #999;/*Chrome y Safari*/
		    -moz-box-shadow:  1px -1px 0px #999;/*Firefox*/
		    -o-box-shadow:  1px -1px 0px #999;/*Opera*/
		    box-shadow:  1px -1px 0px #999;/*Estandar por defecto*/
		    border:1px solid #E3E3E3;
		}

		nav ul li a{
		    color:#999;
		    display:block;
		    padding:10px;
		    text-decoration:none;
		    /*Transiciones*/
		    -webkit-transition: 0.4s linear all;
		    -moz-transition: 0.4s linear all;
		    -o-transition: 0.4s linear all;
		    transition: 0.4s linear all;
		}

		nav ul li a:hover {
		    color:#000;
		}

		#submenu {
			/*left: 0;*/
			opacity: 0;
			position: absolute;
			top: 35px;
			visibility: hidden;
			z-index: 1;
			margin-top: 42px;
		}
		li:hover ul#submenu {
			opacity: 1;
			top: 40px;	/* adjust this as per top nav padding top & bottom comes */
			visibility: visible;
		}
		#submenu li {
			float: none;
			width: 100%;
		}
		#submenu a:hover {
			background: #CCC;
		}
		#submenu a {
			background-color:#E3E3E3;
		}

		/****************** Estilos tablas. *********************/

		table {
		    width:100%;
		    font-size: 11pt;
		}
		table, th, td {
		    border: 1px solid black;
		    border-collapse: collapse;
		}
		th, td {
		    padding: 5px;
		    text-align: left;
		}
		table#tblArticulo tr:nth-child(even) {
		    background-color: #eee;
		}
		table#tblArticulo tr:nth-child(odd) {
		   background-color:#fff;
		}
		table#tblArticulo th	{
		    background-color: lightblue;	
		    color: black;
		}


		

	</style-->
	<style type="text/css">
	table {
		    width:100%;
		    font-size: 11pt;
		}
		table, th, td {
		    border: 1px solid black;
		    border-collapse: collapse;
		}
		th, td {
		    padding: 5px;
		    text-align: left;
		}
		table#tblArticulo tr:nth-child(even) {
		    background-color: #eee;
		}
		table#tblArticulo tr:nth-child(odd) {
		   background-color:#fff;
		}
		table#tblArticulo th	{
		    background-color: #1ab394;	
		    color: white;

		}
	</style>
</head>
<body class="top-navigation">

	<div id="wrapper">
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom white-bg">
                    <nav class="navbar navbar-static-top" role="navigation">
                        <div class="navbar-header">
                            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                <i class="fa fa-reorder"></i>
                            </button>
                            <a href="#" alt="Bolsa de Solicitudes de Mercadeo" class="navbar-brand">LIBRESOFT</a>
                        </div>
                        <div class="navbar-collapse collapse" id="navbar">
                            <ul class="nav navbar-nav">
                                <?php
									if($idrol == 1) {
								?>
                                <li>
                                    <a aria-expanded="false" role="button" href="../venta/venta">
                                        Ventas
                                    </a>
                                </li>
                                <li>
                                    <a aria-expanded="false" role="button" href="../inventario/inventario">
                                        Inventario
                                    </a>
                                </li>
                                <li>
                                    <a aria-expanded="false" role="button" href="../articulo/articulo">
                                        Articulos
                                    </a>
                                </li>
                                <li>
                                    <a aria-expanded="false" role="button" href="../tipoarticulo/tipoarticulo">
                                        Tipo Articulo
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a aria-expanded="false" role="button" href="#"
                                       class="dropdown-toggle" data-toggle="dropdown">
                                        Reportes
                                        <span class="caret"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="../reportes/venta">Ventas</a></li>
                                        <li><a href="../reportes/inventario">Inventario</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a aria-expanded="false" role="button" href="../tipousuario/tipousuario">
                                        Tipo Usuario
                                    </a>
                                </li>
                                <li>
                                    <a aria-expanded="false" role="button" href="../usuario/usuario">
                                        Usuarios
                                    </a>
                                </li>
                                <?php }else if($idrol == 2) { ?>
									<li>
	                                    <a aria-expanded="false" role="button" href="../venta/venta">
	                                        Ventas
	                                    </a>
	                                </li>
								<?php } ?>

                            </ul>
                            <ul class="nav navbar-top-links navbar-right">
                                <li>
                                    <span class="m-r-sm text-muted welcome-message">Bienvenido <?php echo ucwords(strtolower($nomusua)); ?></span>
                                </li>
                                <li>
                                    <a href="../login/login/logout">
                                        <i class="fa fa-sign-out"></i> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <!--?php echo $titulo; ?-->
                <?php $this->load->view($content); ?>        
            </div>
        </div>

        <!--div id="content" class="container middle-box text-center" -->
            <!--?= $titulo; ?-->
            <!--?php $this->load->view($content); ?-->
        <!--/div>< /container -->
        
        
        
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plugins/toastr/toastr.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "400",
                    "hideDuration": "1000",
                    "timeOut": "3000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
        </script>

        <!-- Data Tables -->
        <script src="<?php echo base_url(); ?>public/js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plugins/dataTables/dataTables.responsive.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plugins/jeditable/jquery.jeditable.js"></script>
        <!-- Data Tables -->

        <!-- Page-Level Scripts -->
        <script>
                $(document).ready(function() {
                    var oTable = $('.dataTables-example').dataTable({
                        responsive: true,
                        "dom": 'T<"clear">lfrtip',
                        /*"tableTools": {
                         "sSwfPath": "< ?php echo base_url(); ?>public/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                         }*/
                        language: {
                            url: '<?php echo base_url(); ?>public/js/plugins/dataTables/Spanish.json'
                        }
                    });

                    /* Init DataTables */
                    $('#editable').dataTable();

                    /*Apply the jEditable handlers to the table 
                     oTable.$('td').editable('../example_ajax.php', {
                     "callback": function(sValue, y) {
                     var aPos = oTable.fnGetPosition(this);
                     oTable.fnUpdate(sValue, aPos[0], aPos[1]);
                     },
                     "submitdata": function(value, settings) {
                     return {
                     "row_id": this.parentNode.getAttribute('id'),
                     "column": oTable.fnGetPosition(this)[2]
                     };
                     },
                     "width": "90%",
                     "height": "100%"
                     });*/


                });

                function fnClickAddRow() {
                    $('#editable').dataTable().fnAddData([
                        "Custom row",
                        "New row",
                        "New row",
                        "New row",
                        "New row"]);

                }
        </script>
        <style>
            body.DTTT_Print {
                background: #fff;

            }
            .DTTT_Print #page-wrapper {
                margin: 0;
                background:#fff;
            }

            button.DTTT_button, div.DTTT_button, a.DTTT_button {
                border: 1px solid #e7eaec;
                background: #fff;
                color: #676a6c;
                box-shadow: none;
                padding: 6px 8px;
            }
            button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
                border: 1px solid #d2d2d2;
                background: #fff;
                color: #676a6c;
                box-shadow: none;
                padding: 6px 8px;
            }

            .dataTables_filter label {
                margin-right: 5px;

            }
        </style>
	<!--///////////////////////////////////////////////////////////////////////////////////////////-->
	<!--div id="menu" style="margin-left: auto; margin-right: auto; display: table; padding-top: 25px;">
		<nav>
		<ul>
			<? php
				if($idrol == 1) {
			?>
					<li><a title="Opcion 1" href="../venta/venta">Ventas</a></li>
					<li><a title="Opcion 2" href="../inventario/inventario">Inventario</a></li>
					<li><a title="Opcion 3" href="../articulo/articulo">Articulos</a></li>
					<li><a title="Opcion 4" href="../tipoarticulo/tipoarticulo">Tipo Articulo</a></li>
					<li>
						<a title="Opcion 5" href="#">Reportes</a>
						<ul id="submenu">
				        	<li><a href="../reportes/venta">Ventas</a></li>
					        <li><a href="#">Inventario</a></li>
			
				      	</ul>
					</li>
					<li><a title="Opcion 5" href="../tipousuario/tipousuario">Tipo Usuario</a></li>
					<li><a title="Opcion 6" href="../usuario/usuario">Usuarios</a></li>
			<? php }else if($idrol == 2) { ?>
					<li><a title="Opcion 1" href="../venta/venta">Ventas</a></li>
			<? php } ?>
		</ul>
		</nav>
	</div-->
	<!--div id="content">
		<h1 style="text-align: center;"><?= $titulo; ?></h1>
		<? php $this->load->view($content); ?>
	</div>
	<div id="footer">
		
	</div-->
	<?php 
		if(isset($script)) {
			echo $script;
		} else {
			echo $script;
		}
		
	?>
</body>
</html>