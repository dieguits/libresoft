<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inventario extends CI_Controller {

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
        $this->load->model('/venta/articuloventa_model');
        $this->load->library('session');
    }

    /**
     * Función que valida si el usurio todavia tiene los privilegios de session.
     *
     * @date 14/02/2014.
     * @author Diego.Pérez.
     */
    function _is_loged() {

        if ($this->session->userdata('ingresado') != TRUE) {
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

        $datos = array('content' => 'reportes/inventario',
            'script' => '<script type="text/javascript" src="' . base_url() . 'public/js/inventarioreport.js"></script>',
            'titulo' => 'REPORTE DE VENTAS',
            'idrol' => $this->session->userdata('idrol'),
            'nomusua' => $this->session->userdata('nombres')
        );

        $this->load->view('template/layout', $datos);
    }

    /**
     * Función para burcar reporte de ventas por fechas dadas.
     *
     * @date 18/02/2016.
     * @author Diego.Pérez.
     */
    public function buscarInventario() {
        //echo "vamos super bien ".$this->input->post('fechaini')." ".$this->input->post('fechafin');

        $filtro = array(
            'start' => $this->input->post('start'),
            'length' => $this->input->post('length')
        );
        
        $draw = $this->input->post('draw');

        $data = $this->inventario_model->inventarioActual($filtro);
        $datos = $this->inventario_model->inventarioActualFiltrado($filtro);
        //echo "Excelente ".json_encode($data);
        $rpt['draw'] = $draw;
        $rpt['recordsTotal'] = count($data);
        $rpt['recordsFiltered'] = count($data);
        $rpt['data'] = $datos;

        echo json_encode($rpt);

        //$result = $this->articuloventa_model->consultarVentasFecha($data);
        //echo json_encode($result);
    }

    /**
     * Funcion para generar reporte e imprimir.
     *
     * @author Diego.pérez.
     * @date 29/05/2016
     */
    public function inventarioreport() {
        $this->generarPdf();
        //echo "Aca hacemos el resultado";
    }

    /**
     * Función para generar PDF con la libreria DomPdf.
     *
     * @date 12/01/2016.
     * @author Diego.Pérez.
     */
    public function generarPdf() {

        $this->load->library('html2pdf');

        //establecemos la carpeta en la que queremos guardar los pdfs,
        //si no existen las creamos y damos permisos
        $this->createFolder();

        //importante el slash del final o no funcionará correctamente
        $this->html2pdf->folder('./files/pdfs/');
        //establecemos el nombre del archivo
        $this->html2pdf->filename('reporteInventario.pdf');

        //establecemos el tipo de papel
        $this->html2pdf->paper('letter', 'portrait');

        $result = $this->inventario_model->inventarioActual();
        //echo json_encode($result);
        //datos que queremos enviar a la vista, lo mismo de siempre
        $data = array(
            'titulo' => 'CORPORACION UNION DE HOGARES CRISTIANOS CASA SOBRE LA ROCA',
            'nit' => 'NIT: 800.023.015-1',
            'dir' => 'CALLE 58 # 27 - 32',
            'ciudad' => 'BUCARAMANGA, SANTANDER',
            'telefono' => 'TEL: 6473330',
            'cajero' => strtoupper($this->session->userdata('nombres')),
            'pasaje' => 'MATEO 7:24 Por tanto, todo el que me oye estas palabras y las pone en práctica es como un hombre prudente que construyó su casa sobre la roca.',
            'resultado' => $result
        );

        //hacemos que coja la vista como datos a imprimir
        //importante utf8_decode para mostrar bien las tildes, ñ y demás
        $this->html2pdf->html(utf8_decode($this->load->view('pdf_inventario', $data, true)));

        if ($this->html2pdf->create('save')) {
            //se muestra el pdf
            //$this->show();
            //echo "<script language='javascript'>window.print();</javascript>";
            $this->show();
            echo base_url("files/pdfs/reporteInventario.pdf");
        }
    }

    /**
     * Función para crear foldel de donde se va a crear el pdf.
     *
     * @date 12/01/2016.
     * @author Diego.Pérez.
     */
    private function createFolder() {
        if (!is_dir("./files")) {
            mkdir("./files", 0777);
            mkdir("./files/pdfs", 0777);
        }
    }

    /**
     * Función para mostrar el pdf en pantalla.
     *
     * @date 12/01/2016.
     * @author Diego.Pérez.
     */
    public function show() {
        if (is_dir("./files/pdfs")) {
            $filename = "pdf_inventario.pdf";
            $route = base_url("files/pdfs/" . $filename);
            //echo $route;
            if (file_exists("./files/pdfs/" . $filename)) {
                //echo "Hizo algo";
                header('Content-type: application/pdf');
                readfile($route);
            }
        }
    }

}

?>