<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventario extends CI_Controller {

	/**
	 * Constructor de la clase.
	 *
	 * @date 20/11/2015.
	 * @author Diego.Pérez.
	 */
	function __construct() {
		parent::__construct();
		$this->_is_loged();
		$this->load->model('/inventario/inventario_model');
		$this->load->library('session');

		//$this->load->model('login_model');
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
	 * Función inicializadora de complementos y primaria.
	 *
	 * @date 20/11/2015.
	 * @author Diego.Pérez.
	 */
	public function index() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		//echo "Se ha logrado ingresar";
		$datos = array('content'=> 'inventario/inventario',
			           'script' => '<script type="text/javascript" src="'.base_url().'public/js/inventario.js"></script>',
			           'inventarios' => $this->getInventario(),
			           'titulo' => 'CONTROL INVENTARIO',
			           'idrol' => $this->session->userdata('idrol'),
            		   'nomusua' => $this->session->userdata('nombres')
			           );
		//'login' => $this->session->userdata('login'),
		
		$this->load->view('template/layout', $datos);
	}

	/**
	 * Función que retorna todo el inventario.
	 *
	 * @date 14/02/2014.
	 * @author Diego.Pérez.
	 */
	public function getInventario() {
		//echo "Logramos ingresar a getInventario";
		$inventario = $this->inventario_model->getAllInventario();
		//print_r($inventario[0]->cantidad);
		return $inventario;
	}

	/** 
	 * Método para realizar busqueda de producto para poder agregar al inventario.
	 *
	 * @date 20/02/2014.
	 * @author Diego.Pérez.
	 */
	public function buscar() {
		//echo "Vamos bien compañeros ".$this->input->post('term');

		$busqueda = $this->input->post('term');

		//$rpt['resultado'] = $this->inventario_model->getInventarioBySearch($busqueda);
		//$html_row = $this->load->view("inventario/inventarioresult", $rpt, TRUE);

		//echo $html_row;
		echo json_encode($this->inventario_model->getInventarioBySearch($busqueda));
		
	}

	/**
	 * Método para redireccionar segun la necesidad.
	 *
	 * @date 14/02/2014.
	 * @author Diego.Pérez.
	 */
	public function redireccionar() {
		//print_r($this->input->post('idinventario'));
		//if($this->input->post('idinventario') == -1) {
			//echo "Vamos -1";
		if( !is_null($this->input->post('entrada')) && $this->input->post('entrada') != '') {

			$this->setInventario();
		}
		//}else {
			//echo "Vamos bien";
		//}
		//$inventario = $this->input->post('idinventario');
		//$codigoArti = $this->input->post('codigoarticulo');
		//$nombre = $this->input->post('nombreTipoarti');
		//$cantidad = $this->input->post('cantidad');
		//print_r("Si señores vamos muy bien ".$inventario." ".$codigoArti);
	}

	/**
	 * Método para guardar un registro en inventario.
	 *
	 * @date 21/04/2014.
	 * @author Diego.Pérez.
	 */
	public function setInventario() {

		$codigo = $this->input->post('codigoarticulo');
		//echo $codigo;
		$costo = str_replace('$', '', $this->input->post('costoentrada'));
		$idArticuloInventario = -1;

		$data = array(
					'codigoarticulo' => $codigo,
					'idinventario' => $this->input->post('idinventario'),
					'nombreTipoArti' => $this->input->post('nombreTipoarti'),
					'idarticulo' => $this->input->post('idarticulo'),
					'cantidad' => $this->input->post('cantidad'),
					'cantidadcosto' => $this->input->post('cantidadcosto'),
					'entrada' => $this->input->post('entrada'),
					'costoentrada' => $costo,
					'salida' => $this->input->post('salida'),
					'costosalida' => $this->input->post('costosalida'),
					'usuario' => $this->session->userdata('usuario')
					 );
		//var_dump($data);

		$idArticuloInventario = $this->inventario_model->setInventarioEntrada($data);

		if($idArticuloInventario != -1) {
			$result = $this->inventario_model->setInventario($data);
			$datarpt = array();
			//if(strstr($caracter,'?')){
			if(!strstr($result, '&&')) {
    	    	$datarpt['inve'] = $this->inventario_model->getInventarioById($result);
    	    	//var_dump($datarpt['inve']);
				
				$html_row = $this->load->view("inventario/inventario_row_view",$datarpt,TRUE);
				echo $html_row;
			
			} else {

				$datarpt['inve'] = $this->inventario_model->getInventarioById($data['idinventario']);
				//echo $result;
				$html_row = $this->load->view("inventario/inventario_row_upd",$datarpt,TRUE);
				echo $html_row;
			}
			

		} 

		//echo $idArticuloInventario;

		//$data = array();
		//$data['inv'] = $this->inventario_model->getInventarioById($idArticuloInventario, $codigo);

		//print_r($data['inv']);

		//$html_row = $this->load->view("inventario/inventario_row_view",$data,TRUE);

    	//echo $html_row;
	}

}