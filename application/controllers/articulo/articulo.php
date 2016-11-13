<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articulo extends CI_Controller {

	/**
	 * Constructor de la clase.
	 *
	 * @date 20/11/2015.
	 * @author Diego.Pérez.
	 */
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->_is_loged();
		$this->load->model('/tipoarticulo/tipoarticulo_model');
		$this->load->model('/articulo/articulo_model');
		
		
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
		$datos = array('content'=>'articulo/articulo',
			           'tipoarticulos' => $this->_cargarTipoArticulo(),
			           'script' => '<script type="text/javascript" src="'.base_url().'public/js/articulo.js"></script>',
			           'articulos' => $this->getArticulos(),
			           'titulo' => 'ADMINISTRACION ARTICULOS',
			           'idrol' => $this->session->userdata('idrol'),
            		   'nomusua' => $this->session->userdata('nombres')
			           );
		//$this->load->library('');
		$this->load->view('template/layout', $datos);
	}

	/**
	 * Función para obtener los tipos de articulos ingresados.
	 *
	 * @date 23/11/2015.
	 * @author Diego.Pérez.
	 */
	function _cargarTipoArticulo() {
		$tiposArticulo = $this->tipoarticulo_model->getTipoArticulos();
		//print_r($tiposArticulo->row()->nombretipoarticulo);
		return $tiposArticulo;
	}

	/**
     * Función para obtener los articulos ingresados.
     *
     * @date 12/02/2014.
     * @author Diego.Pérez.
     */
    public function getArticulos() {
    	$articulos = $this->articulo_model->getArticulo();
    	return $articulos;
    }

    /**
     * Función para hacer el redireccionamiento de guardar o actualizar. 
     * 
     * @date 30/01/2014.
     * @author Diego.Pèrez.
     */
    public function redireccionar() {
        
        if($this->input->post('idarticulo') == -1) {
            $this->guardar();
        }else {
            $this->actualizar();
        }
    }

    /**
     * Función para guardar articulo nuevo. 
     * 
     * @date 30/01/2014.
     * @author Diego.Pérez.
     */
    public function guardar()
    {
    	/**$codigo = $this->input->post('codiarti');
    	$nombre = $this->input->post('nombrearticu');
    	$autor = $this->input->post('autorarticu');
    	$tipoarti = $this->input->post('selectarticu');
    	$valorarti = $this->input->post('valorarti');*/

    	//print_r($this->session->userdata('login'));
    	//print_r($this->input->post('selectarticu'));

    	$data = array('codigo' => $this->input->post('codiarti'),
			'nombre' => $this->input->post('nombrearticu'),
			'autor' => $this->input->post('autorarticu'),
			'tipoarti' => $this->input->post('selectarticu'),
			'valorarti' => $this->input->post('valorarti'),
			'valorartiventa' => $this->input->post('valorartiventa'),
			'usuario' => $this->session->userdata('usuario')
		);

    	//OJOOOOOOOO Valiidarrrr
    	$idArticulo = $this->articulo_model->guardarArticulo($data);
    	//echo $idArticulo;
    	$data = array();
    	$data['articulo'] = $this->articulo_model->getArticuloById($idArticulo);
    	//print_r($data['articulo']);
    	$html_row = $this->load->view("articulo/articulo_row_view",$data,TRUE);

    	echo $html_row;
    	
    }

    /**
     * Función para actualizar el articulo seleccionado.
     *
     * @date 15/01/2014.
     * @author Diego.Pérez.
     */
    public function actualizar() {

    	//print_r($this->input->post('idarticulo'));

    	$data = array('idarticulo' => $this->input->post('idarticulo'),
    		'codigo' => $this->input->post('codiarti'),
			'nombre' => $this->input->post('nombrearticu'),
			'autor' => $this->input->post('autorarticu'),
			'tipoarti' => $this->input->post('selectarticu'),
			'valorarti' => $this->input->post('valorarti'),
			'valorartiventa' => $this->input->post('valorartiventa'),
			'usuario' => $this->session->userdata('usuario')
		);

		$this->articulo_model->actualizarArticulo($data);

		/*if($rst) {
			//$this->index();
			redirect('inicio/inicio', 'refresh');x
		}*/
        $data['articulo'] = $this->articulo_model->getArticuloById($this->input->post('idarticulo'));    
        $html_row = $this->load->view("articulo/articulo_row_upd",$data,TRUE);

    	echo $html_row;
    }

}

?>