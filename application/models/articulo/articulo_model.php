<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Articulo_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
		}

		/**
		 * Método para consultar todos los articulos en la base de datos.
		 *
		 * @date 20/11/2013.
		 * @author Diego.Perez.
		 */
		function getArticulo() {
			//return $this->db->get('articulo');
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
					ORDER BY art.idarticulo DESC";
			//print_r($sql->result());
			return $this->db->query($sql);
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
					WHERE  art.idarticulo = ".$idArticulo." ";

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
				'articulo',
				array(
					'codigoarticulo'=>$data['codigo'],
					'nombrearticulo'=>$data['nombre'],
					'autorarticulo'=>$data['autor'],
					'tipoarticulo_idtipoarticulo'=>$data['tipoarti'],
					'valorarticulo'=>$data['valorarti'],
					'valorarticuloventa'=>$data['valorartiventa'],
					'usuarioadd'=>$data['usuario'],
					'fechacrea'=>date("Y-m-d H:i:s"),
					'usuarioactualiza'=>$data['usuario'],
					'fechactuliza'=>date("Y-m-d H:i:s")
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
                            'codigoarticulo'=>$data['codigo'],
                            'nombrearticulo'=>$data['nombre'],
                            'autorarticulo'=>$data['autor'],
                            'tipoarticulo_idtipoarticulo'=>$data['tipoarti'],
                            'valorarticulo'=>$data['valorarti'],
                            'valorarticuloventa'=>$data['valorartiventa'],
                            'usuarioactualiza'=>$data['usuario'],
                            'fechactuliza'=>date("Y-m-d H:i:s")
                        );

            $condicion = "idarticulo = ".$data['idarticulo'];

            $str = $this->db->update_string('articulo', $datos, $condicion); 

            $query = $this->db->query($str);

            return $data['idarticulo'];
		}

		/**
		 * Método para obtener el precio de un articulo determinado.
		 *
		 * @author Diego.Pérez.
		 * @date 30/12/2015.
		 */
		public function getArticuloPrecioById($idArticulo) {

			$sql = "SELECT idarticulo,
						   valorarticulo,
						   valorarticuloventa,
					       nombrearticulo
					FROM   articulo
					WHERE  idarticulo = ".$idArticulo." ";

			$query = $this->db->query($sql);
			$resultado = $query->result();

			return $resultado[0];
		}

	}
?>