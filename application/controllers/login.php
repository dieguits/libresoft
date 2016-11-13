<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('login_model');
		//$this->load->model('inventario/inventario_model');
	}
	
	/**
	 * Función inicializadora de complementos y primaria.
	 *
	 * @date 19/11/2015.
	 * @author Diego.Pérez.
	 */
	public function index()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('login');
	}

	/**
	 * Función para validar el ingreso del usuario.
	 *
	 * @date 19/11/2015.
	 * @author Diego.Pérez.
	 */
	public function ingresar() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('usuario', 'usuario', 'required|callback__autenticar');
        $this->form_validation->set_rules('password', 'contraseña', 'required');
        $this->form_validation->set_message('required', 'Campo %s es requerido');
        $this->form_validation->set_message('_autenticarLdap', 'Error Usuario/Contraseña');
	    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');	

        if ($this->form_validation->run() == FALSE) {
        	$this->load->view('login');
        } else {
        	$this->autenticar();
        }
		
	}

	/**
	 * Función para hacer el login de usuario.
	 *
	 * @date 19/11/2015.
	 * @author Diego.Pérez.
	 **/
	function autenticar() {

		$user = $this->input->post('usuario');
		$pass = $this->input->post('password');
		
		$data = array(
					'usuario' => $user,
					'password' => $pass
					);

		$result = $this->login_model->validarIngreso($data);
		
		//echo $result->nombres.'</br>';
		//echo $result->idusuario.'</br>';
		//echo $result->apellidos.'</br>';
		//echo $result->nombreusuario.'</br>';
		//echo $result->roles_idroles.'</br>';
		//echo "Vamos bien-> ".var_dump($result);
		//echo $result[1];
		//var_dump($result);
		if($result) {
			
			//print('Este-> '.$result['nombres']);
			$nuevosdatos = array(
                   'usuario'  => $result->nombreusuario,
                   'nombres'     => $result->nombres,
                   'idusuario' => $result->idusuario,
                   'apellidos' => $result->apellidos,
                   'idrol' => $result->idrole,
                   'ingresado' => TRUE
               		);

			$this->session->set_userdata($nuevosdatos);

			$datos = array('content'=>'venta/venta',
				           'script' => '<script type="text/javascript" src="'.base_url().'public/js/venta.js"></script>',
				           //'inventarios' => $this->inventario_model->getAllInventario(),
				           'titulo' => 'VENTAS',
				           'idrol' => $this->session->userdata('idrol'),
            		       'nomusua' => $this->session->userdata('nombres')
				           );
		
			$this->load->view('template/layout', $datos);
			//$this->load->view('inventario/inventario', 'index');

		} else {
			echo "Valores Incorrectos, falta hacer que aparezca el mensaje donde debe ser.";
			$this->load->view('login');
		}
		
	}
}