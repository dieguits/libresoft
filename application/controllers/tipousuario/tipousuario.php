<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipousuario extends CI_Controller {

	/**
	 * Constructor de la clase.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->_is_loged();
		$this->load->model('/tipousuario/tipousuario_model');
		
	}

	/**
	 * Función que valida si el usurio todavia tiene los privilegios de session.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	function _is_loged() {
		if ( $this->session->userdata('ingresado') != TRUE)
		{
			redirect('ingresado'); 
		}
	}

	/**
	 * Función de redireccionamiento.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	function index() {
		$datos = array('content'=>'tipousuario/tipousuario',
					   'script' => '<script type="text/javascript" src="'.base_url().'public/js/tipousuario.js"></script>',
			           'tipousuarios' => $this->getCategorias(),
			           'titulo' => 'ADMINISTRACION TIPO DE USUARIO',
			           'idrol' => $this->session->userdata('idrol'),
            		   'nomusua' => $this->session->userdata('nombres')
			           );
		
		$this->load->view('template/layout', $datos);
	}

	/**
	 * Función para obtener las categorias de los productos.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	public function getCategorias() {

		$tipousuarios = $this->tipousuario_model->getTipoUsuarios();
    	return $tipousuarios;
	}

	/**
	 * Función para redireccionar segun el caso.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	public function redireccionar() {

		if($this->input->post('idTipoUsuario') == -1) {
			$this->guardarTipoUsuario();
		}else {
			$this->actualizarTipoUsuario();
		}
	}

	/**
	 * Función para guardar el tipo de usuario.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	function guardarTipoUsuario() {
		//print_r($this->input->post('idTipoArticulo')." ".$this->input->post('nombreTipoarti'));

		$data = array(
					'nombreTipoUsuario' => $this->input->post('nombreTipoUsuario'),
					'codigoTipoUsuario' => $this->input->post('codigoTipoUsuario'),
					'usuario' => $this->session->userdata('usuario')
					 );

		$idTipoUsuario = $this->tipousuario_model->setTipoUsuario($data);

		//echo $idTipoUsuario;

		$data = array();
    	$data['tipo'] = $this->tipousuario_model->getTipoUsuarioById($idTipoUsuario);
    	//print_r($data['articulo']);
    	$html_row = $this->load->view("tipousuario/tipousuario_row_view",$data,TRUE);

    	echo $html_row;
	}

	/**
	 * Función para actualizar el tipo de usuario.
	 *
	 * @date 21/01/2016.
	 * @author Diego.Pérez.
	 */
	function actualizarTipoUsuario() {

		$data = array(
					'idTipoUsuario' => $this->input->post('idTipoUsuario'),
					'nombreTipoUsuario' => $this->input->post('nombreTipoUsuario'),
					'codigoTipoUsuario' => $this->input->post('codigoTipoUsuario'),
					'usuario' => $this->session->userdata('usuario')
					 );	

		$result = $this->tipousuario_model->updTipoUsuario($data);

		$data['tipo'] = $this->tipousuario_model->getTipoUsuarioById($this->input->post('idTipoUsuario'));

		$html_row = $this->load->view("tipousuario/tipousuario_row_upd", $data, TRUE);

		echo $html_row;
	}

}

?>