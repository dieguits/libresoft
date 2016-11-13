<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Tipoarticulo_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
		}

		/**
		 * Método para obtener todos los tipos de articulos de la tabla.
		 *
		 * @date 11/02/2014.
		 * @author Diego.Pérez.
		 */
		function getTipoArticulos() {

			$sql = 'SELECT * 
					FROM   tipoarticulo 
					ORDER BY idtipoarticulo DESC';

			return $this->db->query($sql);
			
			/*$query = $this->db->get('tipoarticulo');
			$query .= $this->db->order_by("idtipoarticulo", "desc");

			if($query->num_rows() > 0) {
				return $query;
			}else {
				return false;
			}*/
		}

		/**
		 * Método para insertar un tipo de articulo nuevo en la tabla.
		 *
		 * @date 11/02/2014.
		 * @author Diego.Pérez.
		 */
		function setTipoArticulo($data) {

			$this->db->insert(
				'tipoarticulo',
				array(
					'nombretipoarticulo'=>$data['nombreTipoArti'],
					'usuariocrea'=>$data['usuario'],
					'fechacrea'=>date("Y-m-d H:i:s"),
					'usuarioactualiza'=>$data['usuario'],
					'fechactualiza'=>date("Y-m-d H:i:s")
				)
			);

			return $this->db->insert_id();
		}

		/**
		 * Método para obtener un tipo de articulo segun el id.
		 *
		 * @date 11/02/2014.
		 * @author Diego.Pérez.
		 */
		function getTipoArticuloById($idTipoArticulo) {

			$sql = "SELECT *
					FROM   tipoarticulo
					WHERE  idtipoarticulo = ".$idTipoArticulo." ";

			//$query = $this->db->get_where('articulo', array('idarticulo' => $idArticulo));
			$query = $this->db->query($sql);
			$resultado = $query->result();
			//print_r($resultado[0]->autorarticulo);
			return $resultado[0];

		}

		/**
		 *
		 *
		 * @date 12/02/2014.
		 * @author Diego.Pérez.
		 */
		function updTipoArticulo($data) {

			$datos = array(
                            'nombretipoarticulo'=>$data['nombreTipoArti'],
                            'usuarioactualiza'=>$data['usuario'],
                            'fechactualiza'=>date("Y-m-d H:i:s")
                        );

			$condicion = "idtipoarticulo = ".$data['idTipoArticulo'];
            $str = $this->db->update_string('tipoarticulo', $datos, $condicion); 
            $query = $this->db->query($str);
            return $query;
		}
	}

?>