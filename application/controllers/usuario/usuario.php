<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	/**
	 * Constructor de la clase.
	 *
	 * @date 22/01/2016.
	 * @author Diego.Pérez.
	 */
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->_is_loged();
		$this->load->model('/usuario/usuario_model');
		$this->load->model('/tipousuario/tipousuario_model');
		
	}

	/**
	 * Función que valida si el usurio todavia tiene los privilegios de session.
	 *
	 * @date 22/01/2016.
	 * @author Diego.Pérez.
	 */
	function _is_loged() {
		if ( $this->session->userdata('ingresado') != TRUE) {
			redirect('ingresado'); 
		}
	}

	/**
	 * Función de redireccionamiento.
	 *
	 * @date 22/01/2016.
	 * @author Diego.Pérez.
	 */
	function index() {
		$datos = array('content'=>'usuario/usuario',
					   'script' => '<script type="text/javascript" src="'.base_url().'public/js/usuario.js"></script>',
			           'usuarios' => $this->getUsuarios(),
			           'tipousuario' => $this->tipousuario_model->getTipoUsuarios(),
			           'titulo' => 'ADMINISTRACION DE USUARIOS',
			           'idrol' => $this->session->userdata('idrol'),
            		   'nomusua' => $this->session->userdata('nombres')
			           );
		
		$this->load->view('template/layout', $datos);
	}

	/**
	 * Función para obtener las categorias de los productos.
	 *
	 * @date 22/01/2016.
	 * @author Diego.Pérez.
	 */
	public function getUsuarios() {

		$usuarios = $this->usuario_model->getUsuarios();
    	return $usuarios;
	}

	/**
	 * Función para redireccionar segun el caso.
	 *
	 * @date 22/01/2016.
	 * @author Diego.Pérez.
	 */
	public function redireccionar() {

		if($this->input->post('idUsuario') == -1) {
			$this->guardarUsuario();
		}else {
			$this->actualizarUsuario();
		}
	}

	/**
	 * Función para guardar el tipo de usuario.
	 *
	 * @date 22/01/2016.
	 * @author Diego.Pérez.
	 */
	function guardarUsuario() {
		//print_r($this->input->post('idTipoArticulo')." ".$this->input->post('nombreTipoarti'));

		$data = array(
					'nombres' => $this->input->post('nombres'),
					'apellidos' => $this->input->post('apellidos'),
					'cedula' => $this->input->post('cedula'),
					'nombreusuario' => $this->input->post('nombreusuario'),
					'clave' => $this->input->post('clave'),
					'idrole' => $this->input->post('role'),
					'usuario' => $this->session->userdata('usuario')
					 );

		$idUsuario = $this->usuario_model->setUsuario($data);

		//echo $idTipoUsuario;

		$data = array();
    	$data['tipo'] = $this->usuario_model->getUsuarioById($idUsuario);
    	print_r($data['tipo']);
    	$html_row = $this->load->view("usuario/usuario_row_view", $data, TRUE);

    	echo $html_row;
	}

	/**
	 * Función para actualizar el tipo de usuario.
	 *
	 * @date 22/01/2016.
	 * @author Diego.Pérez.
	 */
	function actualizarUsuario() {

		$data = array(
					'idUsuario' => $this->input->post('idUsuario'),
					'nombres' => $this->input->post('nombres'),
					'apellidos' => $this->input->post('apellidos'),
					'cedula' => $this->input->post('cedula'),
					'nombreusuario' => $this->input->post('nombreusuario'),
					'clave' => $this->input->post('clave'),
					'idrole' => $this->input->post('role'),
					'usuario' => $this->session->userdata('usuario')
					 );	

		$result = $this->usuario_model->updUsuario($data);

		$data['tipo'] = $this->usuario_model->getUsuarioById($this->input->post('idUsuario'));

		$html_row = $this->load->view("usuario/usuario_row_upd", $data, TRUE);

		echo $html_row;
	}

}

?>