<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipoarticulo extends CI_Controller {

	/**
	 * Constructor de la clase.
	 *
	 * @date 20/11/2015.
	 * @author Diego.Pérez.
	 */
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->_is_loged();
		$this->load->model('/tipoarticulo/tipoarticulo_model');
		
	}

	/**
	 * Función que valida si el usurio todavia tiene los privilegios de session.
	 *
	 * @date 14/02/2014.
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
	 * @date 23/11/2015.
	 * @author Diego.Pérez.
	 */
	function index() {
		$datos = array('content'=>'tipoarticulo/tipoarticulo',
					   'script' => '<script type="text/javascript" src="'.base_url().'public/js/tipoarticulo.js"></script>',
			           'tipoarticulos' => $this->getCategorias(),
			           'titulo' => 'ADMINISTRACION TIPO DE ARTICULO',
			           'idrol' => $this->session->userdata('idrol'),
            		   'nomusua' => $this->session->userdata('nombres')
			           );
		
		$this->load->view('template/layout', $datos);
	}

	/**
	 * Función para obtener las categorias de los productos.
	 *
	 * @date 07/02/2014.
	 * @author Diego.Pérez.
	 */
	public function getCategorias() {

		$tipoarticulos = $this->tipoarticulo_model->getTipoArticulos();
    	return $tipoarticulos;
	}

	/**
	 * Función para redireccionar segun el caso.
	 *
	 * @date 11/02/2014.
	 * @author Diego.Pérez.
	 */
	public function redireccionar() {
		//print_r($this->input->post('idTipoArticulo'));
		if($this->input->post('idTipoArticulo') == -1) {
			$this->guardarTipoArticulo();
		}else {
			$this->actualizarTipoArticulo();
		}
	}

	/**
	 * Función para guardar el tipo de articulo.
	 *
	 * @date 11/02/2014.
	 * @author Diego.Pérez.
	 */
	function guardarTipoArticulo() {
		//print_r($this->input->post('idTipoArticulo')." ".$this->input->post('nombreTipoarti'));

		$data = array(
					'nombreTipoArti' => $this->input->post('nombreTipoarti'),
					'usuario' => $this->session->userdata('usuario')
					 );

		$idTipoArticulo = $this->tipoarticulo_model->setTipoArticulo($data);

		//print_r($idTipoArticulo);

		$data = array();
    	$data['tipo'] = $this->tipoarticulo_model->getTipoArticuloById($idTipoArticulo);
    	//print_r($data['articulo']);
    	$html_row = $this->load->view("tipoarticulo/tipoarticulo_row_view",$data,TRUE);

    	echo $html_row;
	}

	/**
	 * Función para actualizar el tipo de articulo.
	 *
	 * @date 12/02/2014.
	 * @author Diego.Pérez.
	 */
	function actualizarTipoArticulo() {

		$data = array(
					'idTipoArticulo' => $this->input->post('idtiparticulo'),
					'nombreTipoArti' => $this->input->post('nombreTipoarti'),
					'usuario' => $this->session->userdata('usuario')
					 );	

		$result = $this->tipoarticulo_model->updTipoArticulo($data);

		$data['tipo'] = $this->tipoarticulo_model->getTipoArticuloById($this->input->post('idtiparticulo'));

		$html_row = $this->load->view("tipoarticulo/tipoarticulo_row_upd", $data, TRUE);

		echo $html_row;
	}

}

?>