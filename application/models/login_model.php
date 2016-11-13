<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Login_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
		}

		function validarIngreso($data) {
			//print_r($data['usuario']);
			$query = $this->db->get_where('usuario', array('nombreusuario' => $data['usuario'], 'claveusuario' => $data['password']));
			//print_r($query->row()->usuario);
			if($query->num_rows() > 0){
				return $row = $query->row();
				return $query;
				//return true;
			} else
			return false;
		}

	}

?>