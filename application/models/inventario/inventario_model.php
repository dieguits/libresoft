<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventario_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Función para devolver los valores del inventario.
     *
     * @date 14/02/2014.
     * @author Diego.Pérez.
     */
    function getAllInventario() {

        /* $sql = "SELECT inv.idarticuloinventario id,
          inv.cantidadartinventario cantidad,
          inv.usuarioadd usuadd,
          inv.fechacrea fecha,
          art.codigoarticulo codigo,
          art.nombrearticulo nombre,
          art.valorarticulo valor,
          art.autorarticulo autor,
          tip.nombretipoarticulo nombretip,
          entra.canti cantientra,
          entra.valor valorentra,
          entra.fecha fechaentra,
          venta.idventa idventa,
          venta.ventacantidad ventacantidad,
          venta.ventavalor ventavalor
          FROM   articuloinventario inv JOIN articulo art
          ON     inv.articulo_idarticulo = art.idarticulo
          JOIN   tipoarticulo tip
          ON     art.tipoarticulo_idtipoarticulo = tip.idtipoarticulo,
          (SELECT idarticuloentrada idd,
          cantidadarticuloentra canti,
          valorarticuloentra valor,
          articulo_idarticulo idarti,
          fechacrea fecha
          FROM   articuloentrada
          GROUP BY articulo_idarticulo DESC
          ORDER BY idarticuloentrada DESC) entra,
          (SELECT idarticuloventa idventa,
          articuloventacantidad ventacantidad,
          articuloventavalor ventavalor,
          idarticulo_idarticuloventa idarticulo,
          fechacrea fecha
          FROM   articuloventa) venta
          WHERE   inv.articulo_idarticulo = entra.idarti
          AND     inv.articulo_idarticulo = venta.idarticulo
          ORDER BY inv.fechacrea DESC"; */

        $sql = "SELECT inv.idarticuloinventario id,
						   inv.articulo_idarticulo idarticulo,
						   inv.cantidadartinventario cantidad,
						   inv.usuarioadd usuadd,
						   inv.fechacrea fecha,
						   art.codigoarticulo codigo,
						   art.nombrearticulo nombre,
						   art.valorarticulo valor,
						   art.valorarticuloventa valorventa,
						   art.autorarticulo autor,
						   tip.nombretipoarticulo nombretip,
					       entra.canti cantientra,
						   entra.valor valorentra,
						   entra.fecha fechaentra,
					       IFNULL(venta.idarticulo_idarticuloventa, inv.articulo_idarticulo) iddartiventa,
					       /*IFNULL(SUM(venta.articuloventacantidad), 0) ventacantidad,*/
					       IFNULL(venta.articuloventavalor, 0) ventavalor,
					       IFNULL(venta.articuloventavaloruni, 0) ventavaloruni,
					       /*venta.ventacantidad ventacantidad,*/
					       IFNULL((SELECT SUM(articuloventacantidad) 
					        	   FROM   articuloventa 
					        	   WHERE  idarticulo_idarticuloventa = venta.idarticulo_idarticuloventa
					               GROUP BY idarticulo_idarticuloventa), 0) ventacantidad
					FROM   articuloinventario inv JOIN articulo art
					ON     inv.articulo_idarticulo = art.idarticulo
					JOIN   tipoarticulo tip 
					ON     art.tipoarticulo_idtipoarticulo = tip.idtipoarticulo
					LEFT JOIN articuloventa venta
					ON     inv.articulo_idarticulo = venta.idarticulo_idarticuloventa,
					       (SELECT idarticuloentrada idd,
					               cantidadarticuloentra canti,
					               valorarticuloentra valor,
					               articulo_idarticulo idarti,
					               fechacrea fecha
					        FROM   articuloentrada
					        GROUP BY articulo_idarticulo DESC
					        ORDER BY idarticuloentrada DESC) entra
					        /*,(SELECT idarticulo_idarticuloventa iddartiventa
								    ,SUM(articuloventacantidad) ventacantidad
								    ,articuloventavalor ventavalor
							 FROM   articuloventa
							 GROUP BY idarticulo_idarticuloventa) venta*/
					WHERE   inv.articulo_idarticulo = entra.idarti
					/*AND     inv.articulo_idarticulo = venta.iddartiventa(+)*/
					GROUP BY inv.idarticuloinventario
					ORDER BY inv.fechacrea DESC";

        //$query = $this->db->query($sql);
        //$resultado = $query->result();
        //print_r($resultado[0]->id);
        //echo " resultado -> ";
        //var_dump(count($resultado));

        return $this->db->query($sql);
    }

    /**
     * Mètodo para buscar productos en el inventario.
     *
     * @date 20/02/2014.
     * @author Diego.Pérez.
     */
    function getInventarioBySearch($busqueda) {

        /* $sql = "SELECT art.idarticulo id,
          art.codigoarticulo codigo,
          art.nombrearticulo nombre,
          art.valorarticulo valor,
          art.valorarticuloventa valorventa,
          art.autorarticulo autor,
          tart.nombretipoarticulo tipo,
          IFNULL(inve.cantidadartinventario, '0') canti,
          inve.fechacrea fechainve,
          inve.fechactualiza fechactu,
          inve.idarticuloinventario idd,
          IFNULL(SUM(venta.articuloventacantidad), 0) cantiventa,
          venta.fechacrea fechaventa,
          venta.articuloventavaloruni artvalorventa
          FROM   articulo art JOIN tipoarticulo tart
          ON     art.tipoarticulo_idtipoarticulo = tart.idtipoarticulo
          LEFT JOIN articuloinventario inve
          ON     art.idarticulo = inve.articulo_idarticulo
          LEFT JOIN articuloventa venta
          ON     art.idarticulo = venta.idarticulo_idarticuloventa
          WHERE  (art.nombrearticulo LIKE '%".$busqueda."%'
          OR     art.codigoarticulo LIKE '%".$busqueda."%'
          OR     art.autorarticulo LIKE '%".$busqueda."%')
          AND    inve.fechactualiza <= venta.fechacrea "; */
        $sql = "SELECT IFNULL(art.idarticulo, -1) id,
					       art.codigoarticulo codigo,
					       art.nombrearticulo nombre,
					       art.valorarticulo valor,
					       art.valorarticuloventa valorventa,
					       art.autorarticulo autor,
					       tart.nombretipoarticulo tipo,
					       IFNULL(inve.cantidadartinventario, '0') canti,
					       inve.fechacrea fechainve,
                           inve.fechactualiza fechactu,
					       inve.idarticuloinventario idd,
						   IFNULL(SUM(venta.articuloventacantidad), 0) cantiventa,
                           IFNULL(venta.fechacrea, NOW()) fechaventa,
						   IFNULL(venta.articuloventavaloruni, 0) artvalorventa
					FROM   articulo art JOIN tipoarticulo tart
					ON     art.tipoarticulo_idtipoarticulo = tart.idtipoarticulo
					LEFT JOIN articuloinventario inve
					ON     art.idarticulo = inve.articulo_idarticulo
					LEFT JOIN articuloventa venta
					ON     art.idarticulo = venta.idarticulo_idarticuloventa AND    inve.fechactualiza <= venta.fechacrea
					WHERE  (art.nombrearticulo LIKE '%" . $busqueda . "%'
					OR     art.codigoarticulo LIKE '%" . $busqueda . "%'
					OR     art.autorarticulo LIKE '%" . $busqueda . "%') ";

        $query = $this->db->query($sql);


        $resultado = $query->result();
        //$resultado[0]->id;
        //print_r($resultado[0]->nombre);

        return $resultado;
    }

    /**
     * Método para obtener registro por id.
     *
     * @date 03/12/2015.
     * @author Diego.Pérez.
     */
    function getInventarioById($id) {

        /* $sql = "SELECT inv.idarticuloinventario id,
          inv.cantidadartinventario cantidad,
          inv.usuarioadd usuadd,
          inv.fechacrea fecha,
          art.codigoarticulo codigo,
          art.nombrearticulo nombre,
          art.valorarticulo valor,
          art.autorarticulo autor,
          tip.nombretipoarticulo nombretip,
          entra.canti cantientra,
          entra.valor valorentra,
          entra.fecha fechaentra
          FROM   articuloinventario inv JOIN articulo art
          ON     inv.articulo_idarticulo = art.idarticulo
          JOIN   tipoarticulo tip
          ON     art.tipoarticulo_idtipoarticulo = tip.idtipoarticulo,
          (SELECT idarticuloentrada idd,
          cantidadarticuloentra canti,
          valorarticuloentra valor,
          articulo_idarticulo idarti,
          fechacrea fecha
          FROM   articuloentrada
          GROUP BY articulo_idarticulo DESC
          ORDER BY idarticuloentrada DESC) entra
          WHERE   inv.articulo_idarticulo = entra.idarti
          AND     idarticuloinventario = ".$id." "; */

        $sql = "SELECT inv.idarticuloinventario id,
						   inv.articulo_idarticulo idarticulo,
						   inv.cantidadartinventario cantidad,
						   inv.usuarioadd usuadd,
						   inv.fechacrea fecha,
						   inv.fechactualiza fechactu,
						   art.codigoarticulo codigo,
						   art.nombrearticulo nombre,
						   art.valorarticulo valor,
						   art.valorarticuloventa valorventa,
						   art.autorarticulo autor,
						   tip.nombretipoarticulo nombretip,
					       entra.canti cantientra,
						   entra.valor valorentra,
						   entra.fecha fechaentra,
					       IFNULL(venta.idarticulo_idarticuloventa, inv.articulo_idarticulo) iddartiventa,
					       /*IFNULL(SUM(venta.articuloventacantidad), 0) ventacantidad,*/
					       IFNULL(venta.articuloventavalor, 0) ventavalor,
					       IFNULL(venta.articuloventavaloruni, 0) ventavaloruni,
					       /*venta.ventacantidad ventacantidad,*/
					       IFNULL((SELECT SUM(articuloventacantidad) 
					        	   FROM   articuloventa 
					        	   WHERE  idarticulo_idarticuloventa = venta.idarticulo_idarticuloventa
					               GROUP BY idarticulo_idarticuloventa), 0) ventacantidad
					FROM   articuloinventario inv JOIN articulo art
					ON     inv.articulo_idarticulo = art.idarticulo
					JOIN   tipoarticulo tip 
					ON     art.tipoarticulo_idtipoarticulo = tip.idtipoarticulo
					LEFT JOIN articuloventa venta
					ON     inv.articulo_idarticulo = venta.idarticulo_idarticuloventa,
					       (SELECT idarticuloentrada idd,
					               cantidadarticuloentra canti,
					               valorarticuloentra valor,
					               articulo_idarticulo idarti,
					               fechacrea fecha
					        FROM   articuloentrada
					        GROUP BY articulo_idarticulo DESC
					        ORDER BY idarticuloentrada DESC) entra
					        /*,(SELECT idarticulo_idarticuloventa iddartiventa
								    ,SUM(articuloventacantidad) ventacantidad
								    ,articuloventavalor ventavalor
							 FROM   articuloventa
							 GROUP BY idarticulo_idarticuloventa) venta*/
					WHERE   inv.articulo_idarticulo = entra.idarti
					AND     idarticuloinventario = " . $id . "
					GROUP BY inv.idarticuloinventario
					ORDER BY inv.fechacrea DESC ";

        $query = $this->db->query($sql);
        $resultado = $query->result();
        //echo $sql;
        return $resultado[0];

        //return $this->db->query($sql);
    }

    /**
     * Método para insertar articulos al inventario.
     *
     * @date 21/04/2014.
     * @author Diego.Pérez.
     */
    function setInventarioEntrada($data) {

        /* $sql = "INSERT INTO articuloentrada
          (cantidadarticuloentra,
          valorarticuloentra,
          usuariocrea,
          fechacrea,
          usuarioactualiza,
          fechactualiza,
          articulo_idarticulo)
          VALUES     (".$data('entrada').",
          )"; */

        $this->db->insert(
                'articuloentrada', array(
            'cantidadarticuloentra' => $data['entrada'],
            'valorarticuloentra' => $data['costoentrada'],
            'usuariocrea' => $data['usuario'],
            'fechacrea' => date("Y-m-d H:i:s"),
            'usuarioactualiza' => $data['usuario'],
            'fechactualiza' => date("Y-m-d H:i:s"),
            'articulo_idarticulo' => $data['idarticulo']
                )
        );

        return $this->db->insert_id();
    }

    /**
     * Función para agregar o actualizar inventatio.
     *
     * @date 12/12/2015.
     * @author Diego.Pérez.
     */
    function setInventario($data) {

        $sql = "SELECT idarticuloinventario id,
			               cantidadartinventario cantidad
					FROM   articuloinventario
					WHERE  articulo_idarticulo = " . $data['idarticulo'] . " ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            //actualice

            $row = $query->row();

            $cantinve = $row->cantidad;
            $entra = $data['entrada'];
            $sum_cantidad = $cantinve + $entra;

            $datos = array(
                'cantidadartinventario' => $sum_cantidad,
                'usuarioactualiza' => $data['usuario'],
                'fechactualiza' => date("Y-m-d H:i:s"),
                'articulo_idarticulo' => $data['idarticulo']
            );

            $condicion = "articulo_idarticulo = " . $data['idarticulo'];
            $str = $this->db->update_string('articuloinventario', $datos, $condicion);
            $rpt = $this->db->query($str);

            return '&&' . $rpt;
        } else {
            //inserte
            $this->db->insert(
                    'articuloinventario', array(
                'cantidadartinventario' => $data['entrada'],
                'usuarioadd' => $data['usuario'],
                'fechacrea' => date("Y-m-d H:i:s"),
                'usuarioactualiza' => $data['usuario'],
                'fechactualiza' => date("Y-m-d H:i:s"),
                'articulo_idarticulo' => $data['idarticulo']
                    )
            );

            return $this->db->insert_id();
        }
    }

    /**
     * Método para descargar de inventario los productos vendidos.
     *
     * @date 14/01/2016.
     * @author Diego.Pérez.
     */
    function desargaArticulos($array, $usuario) {

        foreach ($array as $val) {

            $cantidadExistente = $this->obtenerCantidad($val->idArticulo);

            if ($cantidadExistente >= $val->cantidadArticulo) {
                $cantidadExistente = $cantidadExistente - $val->cantidadArticulo;
            }

            $datos = array(
                'cantidadartinventario' => $cantidadExistente,
                'usuarioactualiza' => $usuario,
                'fechactualiza' => date("Y-m-d H:i:s")
            );

            $condicion = "articulo_idarticulo = " . $val->idArticulo;

            $str = $this->db->update_string('articuloinventario', $datos, $condicion);

            $query = $this->db->query($str);
        }

        return 1;
    }

    /**
     * Método para obtener el numero de cantidad de un articulo determinado.
     *
     * @date 14/01/2016.
     * @author Diego.Pérez.
     */
    public function obtenerCantidad($idArticulo) {

        $sql = "SELECT cantidadartinventario
					FROM   articuloinventario 
					WHERE  articulo_idarticulo = " . $idArticulo . " ";

        $query = $this->db->query($sql);
        $resultado = $query->result();

        return $resultado[0]->cantidadartinventario;
    }

    /**
     * Método para obtener todo el inventario existente.
     * 
     * @date 09/08/2016.
     * @author Diego.Pérez. 
     */
    public function inventarioActual() {
        
        $sql = "SELECT inv.idarticuloinventario id,
                        inv.articulo_idarticulo idarticulo,
                        inv.cantidadartinventario cantidad,
                        inv.usuarioadd usuadd,
                        inv.fechacrea fecha,
                        art.codigoarticulo codigo,
                        art.nombrearticulo nombre,
                        art.valorarticulo valor,
                        art.valorarticuloventa valorventa,
                        art.autorarticulo autor,
                        tip.nombretipoarticulo nombretip,
                        entra.canti cantientra,
                        entra.valor valorentra,
                        entra.fecha fechaentra
             FROM   articuloinventario inv JOIN articulo art
             ON     inv.articulo_idarticulo = art.idarticulo
             JOIN   tipoarticulo tip 
             ON     art.tipoarticulo_idtipoarticulo = tip.idtipoarticulo,
                    (SELECT idarticuloentrada idd,
                            cantidadarticuloentra canti,
                            valorarticuloentra valor,
                            articulo_idarticulo idarti,
                            fechacrea fecha
                     FROM   articuloentrada
                     GROUP BY articulo_idarticulo DESC
                     ORDER BY idarticuloentrada DESC) entra
             WHERE   inv.articulo_idarticulo = entra.idarti
             GROUP BY inv.idarticuloinventario";
             //ORDER BY @rownum DESC
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result();
    }
    /**
     * Método para obtener todo el inventario existente.
     * 
     * @date 09/08/2016.
     * @author Diego.Pérez. 
     */
    public function inventarioActualFiltrado($data) {
        
        $sql = "SELECT @rownum:=@rownum+1 AS rownum,
                       inv.idarticuloinventario id,
                       inv.articulo_idarticulo idarticulo,
                       inv.cantidadartinventario cantidad,
                       inv.usuarioadd usuadd,
                       inv.fechacrea fecha,
                       art.codigoarticulo codigo,
                       art.nombrearticulo nombre,
                       art.valorarticulo valor,
                       art.valorarticuloventa valorventa,
                       art.autorarticulo autor,
                       tip.nombretipoarticulo nombretip,
                       entra.canti cantientra,
                       entra.valor valorentra,
                       entra.fecha fechaentra
             FROM   articuloinventario inv JOIN articulo art
             ON     inv.articulo_idarticulo = art.idarticulo
             JOIN   tipoarticulo tip 
             ON     art.tipoarticulo_idtipoarticulo = tip.idtipoarticulo,
                    (SELECT idarticuloentrada idd,
                            cantidadarticuloentra canti,
                            valorarticuloentra valor,
                            articulo_idarticulo idarti,
                            fechacrea fecha
                     FROM   articuloentrada
                     GROUP BY articulo_idarticulo DESC
                     ORDER BY idarticuloentrada DESC) entra
             WHERE   inv.articulo_idarticulo = entra.idarti
             GROUP BY inv.idarticuloinventario
             ORDER BY @rownum DESC
             LIMIT  " . $data['length'] . " OFFSET " . $data['start'] . " ";
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result();
    }

}

?>