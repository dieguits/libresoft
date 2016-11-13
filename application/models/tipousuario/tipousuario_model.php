<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Tipousuario_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
		}

		/**
		 * Método para obtener todos los tipos de articulos de la tabla.
		 *
		 * @date 21/01/2016.
		 * @author Diego.Pérez.
		 */
		function getTipoUsuarios() {

			$sql = "SELECT idroles idrol,
					       nombrerol nombre,
					       codigorole codigo,
					       usuarioadd usuariocrea,
					       fechaadd fechacrea,
					       usuarioupd usuarioactualiza,
					       fechaupd fechactualiza
					FROM   roles 
					ORDER BY idroles DESC";

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
		 * @date 21/01/2016.
		 * @author Diego.Pérez.
		 */
		function setTipoUsuario($data) {

			$this->db->insert(
				'roles',
				array(
					'nombrerol' => $data['nombreTipoUsuario'],
					'codigorole' => $data['codigoTipoUsuario'],
					'usuarioadd' => $data['usuario'],
					'fechaadd' => date("Y-m-d H:i:s"),
					'usuarioupd' => $data['usuario'],
					'fechaupd' => date("Y-m-d H:i:s")
				)
			);

			return $this->db->insert_id();
		}

		/**
		 * Método para obtener un tipo de articulo segun el id.
		 *
		 * @date 21/01/2016.
		 * @author Diego.Pérez.
		 */
		function getTipoUsuarioById($idTipoUsuario) {

			$sql = "SELECT idroles idrol,
					       nombrerol nombre,
					       codigorole codigo,
					       usuarioadd usuariocrea,
					       fechaadd fechacrea,
					       usuarioupd usuarioactualiza,
					       fechaupd fechactualiza
					FROM   roles
					WHERE  idroles = ".$idTipoUsuario." ";

			//$query = $this->db->get_where('articulo', array('idarticulo' => $idArticulo));
			$query = $this->db->query($sql);
			$resultado = $query->result();
			//print_r($resultado[0]->autorarticulo);
			return $resultado[0];

		}

		/**
		 * Método para actualizar el tipo de usuario.
		 *
		 * @date 21/01/2016.
		 * @author Diego.Pérez.
		 */
		function updTipoUsuario($data) {

			$datos = array(
                            'nombrerol' => $data['nombreTipoUsuario'],
                            'codigorole' => $data['codigoTipoUsuario'],
                            'usuarioupd' => $data['usuario'],
                            'fechaupd' => date("Y-m-d H:i:s")
                        );

			$condicion = "idroles = ".$data['idTipoUsuario'];
            $str = $this->db->update_string('roles', $datos, $condicion); 
            $query = $this->db->query($str);
            return $query;
		}
	}

?>