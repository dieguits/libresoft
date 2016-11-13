<!DOCTYPE html>
<html>
<head>
	<title>Libresoft</title>
	<meta charset="utf-8">

	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui.min.js"></script>
   
    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>public/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet">
</head>
<body>
	<div class="loginColumns animated fadeInDown">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img style="height: 70px;" src="<?php echo base_url(); ?>/public/images/logo.png" alt="CasaRoca">
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6 text-center">
                    <br><br>
                    <br>
                    <h2 class="font-bold">Bienvenido a LIBRESOFT</h2>

                    <p>
                        Software para la Libreria de CasaRoca.
                    </p>

                    <!--p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </p>

                    <p>
                        When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>

                    <p>
                        <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                    </p-->

                </div>
                <div class="col-md-6">
                    <div class="ibox-content">
                        <form class="m-t" role="form" data-url="" action="<?php echo base_url();?>index.php/login/ingresar" method="post">

                            <div id="divcoduser" class="form-group">
                                <input id="usuario" name="usuario" type="text" class="form-control" placeholder="Usuario" required=""
                                       maxlength="6">
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required="">
                            </div>

                            <button type="submit" id="btnInicio" name="btnInicio" class="btn btn-primary block full-width m-b">
                            	Iniciar Sesion
                            </button>

                            <!--a id="recucontra" href="#" class="text-right">
                                <small>Recuperar Contraseña.</small>
                            </a>
                            <div class="alert alert-danger" id="flag" role="alert">
                                <strong>
                                    Usuario o clave incorrectos.
                                </strong>
                            </div-->
                        </form>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-12 text-center">
                    Copyright 
                    <!--/div>
                    <div class="col-md-6 text-right"-->
                    <small>© 2016 - Casa Sobre la Roca. Creado por Diego Pérez INC.</small>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>public/js/plugins/toastr/toastr.min.js"></script>
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
	<!--center>
		<div>
			
			< ?= form_open(" login/ingresar"); ?>
			< ?php
				$usuario = array(
						'name' => 'usuario',
						'id' => 'usuario',
						'placeholder' => 'Escribe tu usuario'
				);
				$password = array(
						'name' => 'password',
						'id' => 'password',
						'placeholder' => 'Escribe tu contraseña',
						'type' => 'password'
				);
			?>

			< ?= form_label('Usuario: ', 'usuario'); ?>
			< ?= form_input($usuario); ?></br></br>
			< ?= form_error('usuario'); ?>
			< ?= form_label('Contraseña: ', 'password'); ?>
			< ?= form_input($password); ?></br></br>
			< ?= form_error('password'); ?>
			< ?= form_submit('', 'ingresar'); ?>
			< ?= form_close(); ?>
		</div>
	</center-->
</body>
</html>