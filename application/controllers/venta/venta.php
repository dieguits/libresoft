<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venta extends CI_Controller {

	private $myarray;

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
		$this->load->model('/articulo/articulo_model');
		$this->load->model('/venta/articuloventa_model');
		$this->load->library('session');
		//$newarray = array();
		//$this->session->unset_userdata('articulos', $newarray);
		// si no existe la sesión con la variable 'usuario_id'

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
			redirect('login'); 
		}
	}
	
	/**
	 * Función inicializadora de complementos y primaria.
	 *
	 * @date 20/11/2015.
	 * @author Diego.Pérez.
	 */
	public function index() {

		//echo "Se ha logrado ingresar";
		if ($this->session->userdata('articulos')) {
	    	$this->session->unset_userdata('articulos');
	    }
		$datos = array('content'=> 'venta/venta',
			           'script' => '<script type="text/javascript" src="'.base_url().'public/js/venta.js"></script>',
			           'titulo' => 'VENTAS',
			           'idrol' => $this->session->userdata('idrol'),
            		   'nomusua' => $this->session->userdata('nombres')
			           );
		
		$newarray = array();
		$this->session->unset_userdata('articulos'); 
		$this->load->view('template/layout', $datos);
	}

	/**
	 * Función para hacer busqueda de articulo en base de datos.
	 *
	 * @date 18/12/2015.
	 * @author Diego.Pérez.
	 */
	public function buscar() {

		$busqueda = $this->input->post('term');

		echo json_encode($this->inventario_model->getInventarioBySearch($busqueda));
	}
   	
   	/**
   	 * Función para eliminar toda la venta de productor registrados.
   	 *
   	 * @date 12/02/2016.
   	 * @author Diego.Pérez.
   	 */
	public function eliminarVenta() {
		$this->session->unset_userdata('articulos'); 
		echo 'Venta cancelada';
	}

	/**
	 * Método para guardar articulo por articulo en session.
	 *
	 * @date 23/12/2015.
	 * @author Diego.Pérez.
	 */
	public function agregarProducto() {
		
		if($this->input->post('iseliminarproducto') == 1) {
			//echo "se elimino el producto ".$this->input->post('idproducto');

			//SE RECORRE EL ARREGLO GUARDADO EN SESSION Y SE ELIMINA EL PRODUCTO SELECCIONADO.
			$i = 0;
			$this->myarray = array();
			$this->myarray = $this->session->userdata('articulos');

			foreach ($this->myarray as $value) {
				
				if($this->input->post('idproducto') == $value->idArticulo) {
					//echo "Se va a eliminar el producto ".$value->idArticulo;
					unset($this->myarray[$i]);
				}
				
				$i++;
			}
			//SE AGREGA EL NUEVO ARRAY A LA SESSION.
			$this->session->set_userdata('articulos', $this->myarray);
			echo 1;

		}else {

			$variable = $this->input->post('idproducto');
			$canti = $this->input->post('cantidad');

			$cantidad = $this->inventario_model->obtenerCantidad($variable);
			if($cantidad < $canti){
				echo $cantidad;
			}else {

				$articulo = $this->articulo_model->getArticuloPrecioById($variable);

				$this->myarray = array();

				$objeto = new stdClass;
				$objeto->idArticulo = $variable;
				$objeto->cantidadArticulo = $canti;
				//$objeto->valorArticulo = $this->articulo_model->getArticuloPrecioById($variable);
				$objeto->valorArticuloUni = $articulo->valorarticuloventa;
				$objeto->valorArticulo = $articulo->valorarticuloventa * $canti;
				$objeto->nombrearticulo = $articulo->nombrearticulo;

				
				if ( $this->session->userdata('articulos') != TRUE) {
					array_push($this->myarray, $objeto);
					$this->session->set_userdata('articulos', $this->myarray);
				}else {
					$this->myarray = $this->session->userdata('articulos');
					array_push($this->myarray, $objeto);
					$this->session->set_userdata('articulos', $this->myarray);
					//var_dump($this->myarray);
				}
			}
		}

	}

	public function eliminarProducto() {
		echo "aca vamos a eliminar producto";
	}

	/**
	 * Método para relizar el pago y la impresion de la tirilla de pago.
	 *
	 * @date 29/12/2015.
	 * @author Diego.Pérez.
	 */
	public function pagar() {

		$this->myarray = $this->session->userdata('articulos');
		$efectivo = $this->input->post('pago');

		//SE CALCULA EL VALOR DE LA VENTA A REALIZAR.
		$total = 0;
        foreach($this->myarray as $elmt) { 
			$total += $elmt->valorArticulo;
        }
		
		$idfactura = $this->articuloventa_model->venderArticulos($this->myarray, $this->session->userdata('usuario'), $efectivo, $total);
		
		$rpt = $this->inventario_model->desargaArticulos($this->myarray, $this->session->userdata('usuario'));

		if($rpt == 1) {
			$this->generarPdf($this->myarray, $efectivo, $idfactura);
			$this->session->unset_userdata('articulos');
		}
		
	}

	/**
	 * Función para generar PDF con la libreria DomPdf.
	 *
	 * @date 12/01/2016.
	 * @author Diego.Pérez.
	 */
	public function generarPdf($array, $efectivo, $idfactura) {

		$this->load->library('html2pdf');

		//establecemos la carpeta en la que queremos guardar los pdfs,
        //si no existen las creamos y damos permisos
        $this->createFolder();
 
        //importante el slash del final o no funcionará correctamente
        $this->html2pdf->folder('./files/pdfs/');
		//establecemos el nombre del archivo
        $this->html2pdf->filename('test.pdf');

        //establecemos el tipo de papel
        $this->html2pdf->paper('a7', 'portrait');

        //datos que queremos enviar a la vista, lo mismo de siempre
        $data = array(
            'titulo' => 'CORPORACION UNION DE HOGARES CRISTIANOS CASA SOBRE LA ROCA',
            'nit' => 'NIT: 800.023.015-1',
            'dir' => 'CALLE 58 # 27 - 32',
            'ciudad' => 'BUCARAMANGA, SANTANDER',
            'telefono' => 'TEL: 6473330',
            'cajero' => strtoupper($this->session->userdata('nombres')),
            'efectivo' => $efectivo,
            'pasaje' => 'MATEO 7:24 Por tanto, todo el que me oye estas palabras y las pone en práctica es como un hombre prudente que construyó su casa sobre la roca.',
            'idfactura' => $idfactura,
            'array' => $array
        );

        //hacemos que coja la vista como datos a imprimir
        //importante utf8_decode para mostrar bien las tildes, ñ y demás
        $this->html2pdf->html(utf8_decode($this->load->view('pdf', $data, true)));

        if($this->html2pdf->create('save')) {
	        //se muestra el pdf
	        //$this->show();
	        //echo "<script language='javascript'>window.print();</javascript>";
	        echo base_url();
	    }
	}

	/**
	 * Función para mostrar el pdf en pantalla.
	 *
	 * @date 12/01/2016.
	 * @author Diego.Pérez.
	 */
	public function show() {
        if(is_dir("./files/pdfs"))
        {
            $filename = "test.pdf"; 
            $route = base_url("files/pdfs/test.pdf");
            echo $route;
            if(file_exists("./files/pdfs/".$filename))
            {
                header('Content-type: application/pdf'); 
                readfile($route);
            }
        }
    }

    /**
     * Función para crear foldel de donde se va a crear el pdf.
     *
     * @date 12/01/2016.
     * @author Diego.Pérez.
     */
    private function createFolder()
    {
        if(!is_dir("./files"))
        {
            mkdir("./files", 0777);
            mkdir("./files/pdfs", 0777);
        }
    }

}

?>