<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Usuario_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
		}

		/**
		 * Método para obtener todos los tipos de articulos de la tabla.
		 *
		 * @date 21/01/2016.
		 * @author Diego.Pérez.
		 */
		function getUsuarios() {

			$sql = "SELECT usu.idusuario idUsuario,
					       usu.nombres nombres,
					       usu.apellidos apellidos,
					       usu.cedula cedula,
					       usu.nombreusuario nombreusuario,
					       usu.usuarioadd usuarioadd,
					       usu.fechaadd fechaadd,
					       usu.usuarioupd usuarioupd,
					       usu.fechaupd fechaupd,
					       usu.idrole idrole,
                           rol.nombrerol tipoUsuario
					FROM   usuario usu
                    JOIN   roles rol
                    ON     usu.idrole = rol.idroles
					ORDER BY idusuario DESC ";

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
		function setUsuario($data) {

			$this->db->insert(
				'usuario',
				array(
					'nombres' => $data['nombres'],
					'apellidos' => $data['apellidos'],
					'cedula' => $data['cedula'],
					'nombreusuario' => $data['nombreusuario'],
					'claveusuario' => $data['clave'],
					'idrole' => $data['idrole'],
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
		function getUsuarioById($idUsuario) {

			$sql = "SELECT usu.idusuario idUsuario,
					       usu.nombres nombres,
					       usu.apellidos apellidos,
					       usu.cedula cedula,
					       usu.nombreusuario nombreusuario,
					       usu.usuarioadd usuarioadd,
					       usu.fechaadd fechaadd,
					       usu.usuarioupd usuarioupd,
					       usu.fechaupd fechaupd,
					       usu.idrole idrole,
                           rol.nombrerol tipoUsuario
					FROM   usuario usu
                    JOIN   roles rol
                    ON     usu.idrole = rol.idroles
					WHERE  usu.idusuario = ".$idUsuario." ";

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
		function updUsuario($data) {

			if($data['clave'] == '') {
				$datos = array(
                            'nombres' => $data['nombres'],
							'apellidos' => $data['apellidos'],
							'cedula' => $data['cedula'],
							'nombreusuario' => $data['nombreusuario'],
							'idrole' => $data['idrole'],
                            'usuarioupd' => $data['usuario'],
                            'fechaupd' => date("Y-m-d H:i:s")
                        );
			}else {
				$datos = array(
                            'nombres' => $data['nombres'],
							'apellidos' => $data['apellidos'],
							'cedula' => $data['cedula'],
							'nombreusuario' => $data['nombreusuario'],
							'claveusuario' => $data['clave'],
							'idrole' => $data['idrole'],
                            'usuarioupd' => $data['usuario'],
                            'fechaupd' => date("Y-m-d H:i:s")
                        );	
			}
			

			$condicion = "idUsuario = ".$data['idUsuario'];
            $str = $this->db->update_string('usuario', $datos, $condicion); 
            $query = $this->db->query($str);
            return $query;
		}
	}

?>