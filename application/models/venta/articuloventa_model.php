<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Articuloventa_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Método para hacer la inserción en la base de datos de los artulos que se vende.
     *
     * @date 30/12/2015.
     * @author Diego.Pérez.
     */
    function venderArticulos($articulos, $usuario, $efectivo, $total) {

        /* $sql_factura = "INSERT INTO articulofactura 
          (totalarticulofactura,
          efectivofactura,
          usuariofactura,
          fechafactura)
          VALUES (".$total.",
          ".$efectivo.",
          '".$usuario."',
          '".date('Y-m-d H:i:s')."' )"; */

        $this->db->insert(
                'articulofactura', array(
            'totalarticulofactura' => $total,
            'efectivofactura' => $efectivo,
            'usuariofactura' => $usuario,
            'fechafactura' => date("Y-m-d H:i:s")
                )
        );

        //$query = $this->db->query($sql);
        $idfacturainsert = $this->db->insert_id();

        foreach ($articulos as $value) {
            $sql = "INSERT INTO articuloventa
							   (articuloventacantidad,
							   	articuloventavaloruni,
							   	articuloventavalor,
							   	idarticulo_idarticuloventa,
							   	usuarioactualiza,
							   	fechactualiza,
							   	usuariocrea,
							   	fechacrea,
							   	idarticulofactura)
				        VALUES (" . $value->cantidadArticulo . ",
				        	    " . $value->valorArticuloUni . ",
				        	    " . $value->valorArticulo . ",
				        	    " . $value->idArticulo . ",
				        	    '" . $usuario . "',
				        	    '" . date('Y-m-d H:i:s') . "',
				        	    '" . $usuario . "',
				        	    '" . date('Y-m-d H:i:s') . "',
				        	    " . $idfacturainsert . " )";

            $this->db->query($sql);
            //echo $value->idArticulo.' - '.$value->cantidadArticulo.'</br>';
        }

        return $idfacturainsert;
    }

    /**
     * Método para consultar los articulos por id. 
     *
     * @date 14/01/2014.
     * @author Diego.Pérez.
     */
    function getArticuloById($idArticulo) {

        $sql = "SELECT art.idarticulo, 
					       art.codigoarticulo, 
					       art.nombrearticulo, 
					       art.autorarticulo, 
					       art.valorarticulo,
					       art.valorarticuloventa,
					       tip.nombretipoarticulo,
                           art.tipoarticulo_idtipoarticulo tipoarticulo
					FROM   articulo art JOIN tipoarticulo tip
					ON     art.tipoarticulo_idtipoarticulo = tip.idtipoarticulo
					WHERE  art.idarticulo = " . $idArticulo . " ";

        //$query = $this->db->get_where('articulo', array('idarticulo' => $idArticulo));
        $query = $this->db->query($sql);
        $resultado = $query->result();
        //print_r($resultado[0]->autorarticulo);
        return $resultado[0];
    }

    /**
     * Método para guardar un nuevo articulo.
     *
     * @date 20/11/2013.
     * @author Diego.Pérez.
     */
    function guardarArticulo($data) {
        $this->db->insert(
                'articulo', array(
            'codigoarticulo' => $data['codigo'],
            'nombrearticulo' => $data['nombre'],
            'autorarticulo' => $data['autor'],
            'tipoarticulo_idtipoarticulo' => $data['tipoarti'],
            'valorarticulo' => $data['valorarti'],
            'valorarticuloventa' => $data['valorartiventa'],
            'usuarioadd' => $data['usuario'],
            'fechacrea' => date("Y-m-d H:i:s"),
            'usuarioactualiza' => $data['usuario'],
            'fechactuliza' => date("Y-m-d H:i:s")
                )
        );

        return $this->db->insert_id();
    }

    /**
     * Método para actualizar un articulo que haya sido seleccionado.
     *
     * @date 16/01/2014.
     * @author Diego.Pérez.
     */
    function actualizarArticulo($data) {

        $datos = array(
            'codigoarticulo' => $data['codigo'],
            'nombrearticulo' => $data['nombre'],
            'autorarticulo' => $data['autor'],
            'tipoarticulo_idtipoarticulo' => $data['tipoarti'],
            'valorarticulo' => $data['valorarti'],
            'valorarticuloventa' => $data['valorartiventa'],
            'usuarioactualiza' => $data['usuario'],
            'fechactuliza' => date("Y-m-d H:i:s")
        );

        $condicion = "idarticulo = " . $data['idarticulo'];

        $str = $this->db->update_string('articulo', $datos, $condicion);

        $query = $this->db->query($str);

        return $data['idarticulo'];
    }

    /**
     * Método para consultar las ventas de determinado periodo o fecha.
     *
     * @date 18/02/2016.
     * @author Diego.Pérez.
     */
    function consultarVentasFecha($data) {

        $sql = "SELECT @rownum:=@rownum+1 AS rownum, 
                       artvt.idarticuloventa idarticuloventa,
		       artvt.articuloventacantidad cantidadventa,
		       artvt.articuloventavaloruni valoruni,
		       artvt.articuloventavalor valor,
		       artvt.usuariocrea usuario,
		       artvt.fechacrea fecha,
                       art.nombrearticulo nombrearticulo,
                       artvt.idarticulo_idarticuloventa idarticulo
		FROM   (SELECT @rownum:=0) r,
                       articuloventa artvt JOIN articulo art
                  ON   artvt.idarticulo_idarticuloventa = art.idarticulo
		WHERE  artvt.fechacrea >= '" . $data['fechaInicio'] . "'
		AND    artvt.fechacrea <= '" . $data['fechaFin'] . "'
		ORDER BY @rownum, artvt.fechacrea";
        //echo $data['fechaInicio']." - ".$data['fechaFin'];
        $query = $this->db->query($sql);
        $resultado = $query->result();

        return $resultado;
    }

    /**
     * Mètodo para consultar las ventas de modo filtrado para la tabla.
     *
     * @date 25/06/2016.
     * @author Diego.Perez.
     */
    function consultarVentasFechaFiltrado($data) {

        $sql = "SELECT @rownum:=@rownum+1 AS rownum, 
                        artvt.idarticuloventa idarticuloventa,
                        artvt.articuloventacantidad cantidadventa,
                        artvt.articuloventavaloruni valoruni,
                        artvt.articuloventavalor valor,
                        artvt.usuariocrea usuario,
                        DATE_FORMAT(artvt.fechacrea, '%d/%m/%Y %h:%i:%s %p') fecha,
                        art.nombrearticulo nombrearticulo,
                        artvt.idarticulo_idarticuloventa idarticulo
                   FROM (SELECT @rownum:=0) r,
                        articuloventa artvt JOIN articulo art
                        ON artvt.idarticulo_idarticuloventa = art.idarticulo
		 WHERE  artvt.fechacrea >= STR_TO_DATE('" . $data['fechaInicio'] . "', '%d/%m/%Y')
		   AND  artvt.fechacrea <= STR_TO_DATE('" . $data['fechaFin'] . "', '%d/%m/%Y')
		 ORDER BY @rownum, artvt.fechacrea
		 LIMIT  " . $data['length'] . " OFFSET " . $data['start'] . " ";
        //echo $sql;
        $query = $this->db->query($sql);
        $resultado = $query->result();

        return $resultado;
    }

}

?>